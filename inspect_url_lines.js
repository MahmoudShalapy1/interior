const { spawn } = require('child_process');
const http = require('http');

async function testUrl(url) {
  const edge = spawn('C:\\Program Files (x86)\\Microsoft\\Edge\\Application\\msedge.exe', [
    '--headless=new',
    '--window-size=1920,1080',
    '--remote-debugging-port=9222',
    '--disable-gpu',
    '--no-first-run',
    '--no-default-browser-check',
    '--user-data-dir=' + require('os').tmpdir() + '/edge-lines-' + Date.now(),
    url
  ]);
  await new Promise(r => setTimeout(r, 4000));
  const targets = await new Promise(res => http.get('http://127.0.0.1:9222/json/list', r => {
    let d = ''; r.on('data', c => d += c); r.on('end', () => res(JSON.parse(d)));
  }));
  const page = targets.find(t => t.url.includes('interior.local')) || targets[0];
  const ws = new WebSocket(page.webSocketDebuggerUrl);
  await new Promise(r => ws.addEventListener('open', r, { once: true }));
  function send(method, params = {}) {
    return new Promise(resolve => {
      const id = Math.floor(Math.random() * 100000);
      function onMsg(e) {
        const m = JSON.parse(e.data);
        if (m.id === id) { ws.removeEventListener('message', onMsg); resolve(m); }
      }
      ws.addEventListener('message', onMsg);
      ws.send(JSON.stringify({ id, method, params }));
    });
  }

  const res = await send('Runtime.evaluate', {
    expression: `(() => {
      const elms = Array.from(document.querySelectorAll('#main-content > *'));
      return JSON.stringify(elms.map((el, i) => {
        const s = window.getComputedStyle(el);
        return {
          idx: i,
          tag: el.tagName,
          id: el.id,
          cls: el.className.split(' ').slice(0, 3).join(' '),
          borderTop: s.borderTop,
          borderBottom: s.borderBottom,
          height: el.offsetHeight
        };
      }));
    })()`,
    returnByValue: true
  });
  console.log('=== ' + url + ' ===');
  console.log(JSON.parse(res.result.result.value));
  edge.kill();
}

async function main() {
  for (const p of ['services', 'approach', 'projects', 'contact']) {
    await testUrl('http://interior.local/' + p + '/');
    await new Promise(r => setTimeout(r, 1000));
  }
  process.exit(0);
}
main();
