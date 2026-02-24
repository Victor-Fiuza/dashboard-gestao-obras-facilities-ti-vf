<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Dashboard Arena </title>
<link href="https://fonts.googleapis.com/css2?family=DM+Sans:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
<style>
  :root {
    --bg-primary: #0a0e1a;
    --bg-secondary: #111827;
    --bg-card: #1a2035;
    --border: rgba(255,255,255,0.06);
    --text-primary: #f1f5f9;
    --text-secondary: #94a3b8;
    --text-muted: #64748b;
    --accent: #3b82f6;
    --accent-glow: rgba(59,130,246,0.15);
    --green: #22c55e;
    --green-bg: rgba(34,197,94,0.1);
    --green-border: rgba(34,197,94,0.25);
    --yellow: #eab308;
    --yellow-bg: rgba(234,179,8,0.1);
    --yellow-border: rgba(234,179,8,0.25);
    --red: #ef4444;
    --red-bg: rgba(239,68,68,0.1);
    --red-border: rgba(239,68,68,0.25);
    --blue: #3b82f6;
    --blue-bg: rgba(59,130,246,0.1);
    --blue-border: rgba(59,130,246,0.25);
    --purple: #a855f7;
    --purple-bg: rgba(168,85,247,0.1);
    --orange: #f97316;
    --orange-bg: rgba(249,115,22,0.1);
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg-primary);
    color: var(--text-primary);
    min-height: 100vh;
    overflow-x: hidden;
  }

  .header {
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #0f172a 100%);
    border-bottom: 1px solid var(--border);
    padding: 1.2rem 2.5rem;
    display: flex; justify-content: space-between; align-items: center;
    position: sticky; top: 0; z-index: 100; backdrop-filter: blur(20px);
  }

  .header-left { display: flex; align-items: center; gap: 1.2rem; }
  .logo-icon { height: 44px; display: flex; align-items: center; justify-content: center; flex-shrink: 0; }
  .logo-icon img { height: 40px; width: auto; object-fit: contain; filter: brightness(1.1); }

  .header-title {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.5rem; font-weight: 700;
    background: linear-gradient(135deg, #f1f5f9, #94a3b8);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  }

  .header-subtitle { font-size: 0.78rem; color: var(--text-muted); letter-spacing: 0.5px; }
  .header-right { display: flex; align-items: center; gap: 1.5rem; }

  .clock { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.6rem; font-weight: 600; color: var(--text-secondary); letter-spacing: 1px; }
  .clock-date { font-size: 0.75rem; color: var(--text-muted); text-align: right; }

  .sync-indicator { display: flex; align-items: center; gap: 0.4rem; font-size: 0.72rem; color: var(--green); opacity: 0; transition: opacity 0.3s; }
  .sync-indicator.active { opacity: 1; }
  .sync-dot { width: 6px; height: 6px; border-radius: 50%; background: var(--green); animation: syncPulse 1.5s infinite; }
  @keyframes syncPulse { 0%, 100% { opacity: 0.4; } 50% { opacity: 1; } }

  .tabs {
    display: flex; gap: 0.5rem; padding: 1rem 2.5rem;
    background: var(--bg-secondary); border-bottom: 1px solid var(--border);
  }

  .tab {
    padding: 0.7rem 1.8rem; border-radius: 10px; cursor: pointer;
    font-size: 0.92rem; font-weight: 600; color: var(--text-muted);
    transition: all 0.3s ease; border: 1px solid transparent;
    display: flex; align-items: center; gap: 0.6rem; user-select: none;
  }

  .tab:hover { color: var(--text-secondary); background: rgba(255,255,255,0.03); }
  .tab.active { background: var(--accent-glow); color: var(--accent); border-color: rgba(59,130,246,0.3); box-shadow: 0 0 20px rgba(59,130,246,0.1); }
  .tab-icon { font-size: 1.1rem; }
  .tab-badge { background: var(--red); color: white; font-size: 0.65rem; padding: 0.15rem 0.5rem; border-radius: 20px; font-weight: 700; }

  .main { padding: 1.5rem 2.5rem 2rem; }
  .tab-content { display: none; animation: fadeIn 0.4s ease; }
  .tab-content.active { display: block; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

  .stats-row { display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 1rem; margin-bottom: 1.8rem; }

  .stat-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 14px; padding: 1.3rem 1.5rem; position: relative; overflow: hidden; }
  .stat-card::before { content: ''; position: absolute; top: 0; left: 0; right: 0; height: 3px; border-radius: 14px 14px 0 0; }
  .stat-card.green::before { background: var(--green); }
  .stat-card.yellow::before { background: var(--yellow); }
  .stat-card.red::before { background: var(--red); }
  .stat-card.blue::before { background: var(--accent); }

  .stat-label { font-size: 0.78rem; color: var(--text-muted); text-transform: uppercase; letter-spacing: 1px; font-weight: 600; margin-bottom: 0.5rem; }
  .stat-value { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 2.2rem; font-weight: 800; }
  .stat-card.green .stat-value { color: var(--green); }
  .stat-card.yellow .stat-value { color: var(--yellow); }
  .stat-card.red .stat-value { color: var(--red); }
  .stat-card.blue .stat-value { color: var(--accent); }

  .table-container { background: var(--bg-card); border: 1px solid var(--border); border-radius: 16px; overflow: hidden; }
  .table-header-bar { padding: 1.2rem 1.5rem; display: flex; justify-content: space-between; align-items: center; border-bottom: 1px solid var(--border); }
  .table-title { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.1rem; font-weight: 700; }
  .table-scroll { overflow-x: auto; }

  table { width: 100%; border-collapse: collapse; font-size: 0.92rem; }
  thead th { padding: 1rem 1.3rem; text-align: left; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 1.2px; color: var(--text-muted); font-weight: 700; border-bottom: 1px solid var(--border); background: rgba(0,0,0,0.2); white-space: nowrap; }
  tbody td { padding: 1rem 1.3rem; border-bottom: 1px solid var(--border); vertical-align: middle; }
  tbody tr { transition: background 0.2s; }
  tbody tr:hover { background: rgba(255,255,255,0.02); }
  tbody tr:last-child td { border-bottom: none; }

  .status-badge { display: inline-flex; align-items: center; gap: 0.45rem; padding: 0.4rem 1rem; border-radius: 50px; font-size: 0.82rem; font-weight: 600; white-space: nowrap; }
  .status-dot { width: 8px; height: 8px; border-radius: 50%; flex-shrink: 0; }
  .status-bom { background: var(--green-bg); color: var(--green); border: 1px solid var(--green-border); }
  .status-bom .status-dot { background: var(--green); box-shadow: 0 0 8px var(--green); }
  .status-atencao { background: var(--yellow-bg); color: var(--yellow); border: 1px solid var(--yellow-border); }
  .status-atencao .status-dot { background: var(--yellow); box-shadow: 0 0 8px var(--yellow); }
  .status-ruim { background: var(--red-bg); color: var(--red); border: 1px solid var(--red-border); }
  .status-ruim .status-dot { background: var(--red); box-shadow: 0 0 8px var(--red); animation: pulse-red 2s infinite; }
  @keyframes pulse-red { 0%, 100% { box-shadow: 0 0 4px var(--red); } 50% { box-shadow: 0 0 14px var(--red); } }

  .obs-text { max-width: 280px; color: var(--text-secondary); font-size: 0.85rem; line-height: 1.4; }
  .date-cell { color: var(--text-secondary); white-space: nowrap; }
  .system-name { font-weight: 600; color: var(--text-primary); display: flex; align-items: center; gap: 0.6rem; }
  .system-icon { width: 34px; height: 34px; border-radius: 10px; display: flex; align-items: center; justify-content: center; font-size: 1rem; flex-shrink: 0; }

  .obras-grid { display: grid; grid-template-columns: repeat(auto-fill, minmax(380px, 1fr)); gap: 1.2rem; }
  .obra-card { background: var(--bg-card); border: 1px solid var(--border); border-radius: 16px; padding: 1.5rem; transition: all 0.3s ease; position: relative; overflow: hidden; }
  .obra-card:hover { border-color: rgba(59,130,246,0.2); transform: translateY(-2px); box-shadow: 0 8px 30px rgba(0,0,0,0.3); }
  .obra-header { display: flex; justify-content: space-between; align-items: flex-start; margin-bottom: 1rem; }
  .obra-name { font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.1rem; font-weight: 700; margin-bottom: 0.3rem; }
  .obra-location { font-size: 0.8rem; color: var(--text-muted); display: flex; align-items: center; gap: 0.3rem; }
  .obra-phase-badge { padding: 0.35rem 0.9rem; border-radius: 50px; font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.5px; flex-shrink: 0; }
  .phase-fundacao { background: var(--blue-bg); color: var(--blue); border: 1px solid var(--blue-border); }
  .phase-estrutura { background: var(--purple-bg); color: var(--purple); border: 1px solid rgba(168,85,247,0.25); }
  .phase-acabamento { background: var(--orange-bg); color: var(--orange); border: 1px solid rgba(249,115,22,0.25); }
  .phase-concluida { background: var(--green-bg); color: var(--green); border: 1px solid var(--green-border); }
  .phase-planejamento { background: rgba(100,116,139,0.15); color: var(--text-secondary); border: 1px solid rgba(100,116,139,0.25); }
  .progress-section { margin: 1rem 0; }
  .progress-info { display: flex; justify-content: space-between; margin-bottom: 0.5rem; font-size: 0.8rem; }
  .progress-label { color: var(--text-muted); }
  .progress-value { font-weight: 700; font-family: 'Plus Jakarta Sans', sans-serif; }
  .progress-bar { height: 8px; background: rgba(255,255,255,0.05); border-radius: 10px; overflow: hidden; }
  .progress-fill { height: 100%; border-radius: 10px; transition: width 1s ease; position: relative; }
  .progress-fill::after { content: ''; position: absolute; top: 0; left: 0; right: 0; bottom: 0; background: linear-gradient(90deg, transparent, rgba(255,255,255,0.2), transparent); animation: shimmer 2s infinite; }
  @keyframes shimmer { 0% { transform: translateX(-100%); } 100% { transform: translateX(100%); } }
  .obra-details { display: grid; grid-template-columns: 1fr 1fr; gap: 0.6rem; margin-top: 1rem; padding-top: 1rem; border-top: 1px solid var(--border); }
  .obra-detail-item { font-size: 0.78rem; }
  .obra-detail-label { color: var(--text-muted); margin-bottom: 0.15rem; }
  .obra-detail-value { color: var(--text-primary); font-weight: 600; }

  @media (max-width: 768px) {
    .header { padding: 1rem 1.2rem; }
    .main { padding: 1rem 1.2rem; }
    .tabs { padding: 0.8rem 1.2rem; overflow-x: auto; }
    .tab { padding: 0.6rem 1.2rem; font-size: 0.82rem; white-space: nowrap; }
    .obras-grid { grid-template-columns: 1fr; }
    .stats-row { grid-template-columns: repeat(2, 1fr); }
    .header-title { font-size: 1.1rem; }
    .clock { font-size: 1.2rem; }
  }

  @media (min-width: 1920px) {
    .header { padding: 1.5rem 3.5rem; }
    .tabs { padding: 1.2rem 3.5rem; }
    .main { padding: 2rem 3.5rem; }
    .header-title { font-size: 1.8rem; }
    .clock { font-size: 2rem; }
    table { font-size: 1.05rem; }
    thead th { font-size: 0.82rem; padding: 1.2rem 1.5rem; }
    tbody td { padding: 1.2rem 1.5rem; }
    .stat-value { font-size: 2.8rem; }
    .stat-label { font-size: 0.88rem; }
    .obra-name { font-size: 1.25rem; }
    .tab { font-size: 1.05rem; padding: 0.9rem 2.2rem; }
  }

  @media (min-width: 2560px) {
    .header { padding: 2rem 5rem; }
    .tabs { padding: 1.5rem 5rem; }
    .main { padding: 2.5rem 5rem; }
    .header-title { font-size: 2.2rem; }
    .clock { font-size: 2.5rem; }
    table { font-size: 1.2rem; }
    thead th { font-size: 0.95rem; }
    .stat-value { font-size: 3.5rem; }
    .tab { font-size: 1.2rem; }
  }

  ::-webkit-scrollbar { width: 6px; height: 6px; }
  ::-webkit-scrollbar-track { background: transparent; }
  ::-webkit-scrollbar-thumb { background: rgba(255,255,255,0.1); border-radius: 3px; }
</style>
</head>
<body>

<header class="header">
  <div class="header-left">
    <div class="logo-icon">DC</div>
    <div>
      <div class="header-title">Arena </div>
      <div class="header-subtitle">PAINEL DE GESTÃO — DIRETORIA</div>
    </div>
  </div>
  <div class="header-right">
    <div class="sync-indicator" id="syncIndicator"><span class="sync-dot"></span> Sincronizado</div>
    <div>
      <div class="clock" id="clock">--:--:--</div>
      <div class="clock-date" id="clockDate">--</div>
    </div>
  </div>
</header>

<nav class="tabs">
  <div class="tab active" data-tab="manutencao"><span class="tab-icon">🔧</span> Manutenção <span class="tab-badge" id="badgeManut" style="display:none">0</span></div>
  <div class="tab" data-tab="obras"><span class="tab-icon">🏗️</span> Status das Obras</div>
</nav>

<main class="main">
  <div class="tab-content active" id="tab-manutencao">
    <div class="stats-row" id="manutStats"></div>
    <div class="table-container">
      <div class="table-header-bar">
        <div class="table-title">📋 Registro de Manutenções</div>
        <div style="font-size:0.78rem;color:var(--text-muted)" id="lastUpdate">Carregando...</div>
      </div>
      <div class="table-scroll">
        <table>
          <thead><tr><th>Sistema</th><th>Última Manutenção</th><th>Status</th><th>Observação</th><th>Próxima Manutenção</th></tr></thead>
          <tbody id="manutTableBody"><tr><td colspan="5" style="text-align:center;padding:2rem;color:var(--text-muted)">Carregando dados...</td></tr></tbody>
        </table>
      </div>
    </div>
  </div>

  <div class="tab-content" id="tab-obras">
    <div class="stats-row" id="obrasStats"></div>
    <div class="obras-grid" id="obrasGrid"><div style="text-align:center;padding:2rem;color:var(--text-muted)">Carregando obras...</div></div>
  </div>
</main>

<script>
const API = 'api.php';
let manutencoes = [], obras = [];

async function apiCall(resource) {
  const res = await fetch(`${API}?resource=${resource}`);
  if (!res.ok) throw new Error('Erro ao carregar dados');
  return res.json();
}

function showSync() {
  const el = document.getElementById('syncIndicator');
  el.classList.add('active');
  setTimeout(() => el.classList.remove('active'), 2500);
}

function updateClock() {
  const now = new Date();
  document.getElementById('clock').textContent = now.toLocaleTimeString('pt-BR');
  document.getElementById('clockDate').textContent = now.toLocaleDateString('pt-BR', { weekday: 'long', day: '2-digit', month: 'long', year: 'numeric' });
}
setInterval(updateClock, 1000);
updateClock();

document.querySelectorAll('.tab').forEach(tab => {
  tab.addEventListener('click', () => {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
    tab.classList.add('active');
    document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
  });
});

function formatDate(d) { if (!d) return '—'; const [y, m, day] = d.split('-'); return `${day}/${m}/${y}`; }
function escapeHtml(str) { if (!str) return ''; const div = document.createElement('div'); div.textContent = str; return div.innerHTML; }

function renderManut() {
  const tbody = document.getElementById('manutTableBody');
  const bom = manutencoes.filter(m => m.status === 'Bom').length;
  const atencao = manutencoes.filter(m => m.status === 'Atenção').length;
  const ruim = manutencoes.filter(m => m.status === 'Ruim').length;
  const badge = document.getElementById('badgeManut');
  badge.textContent = ruim; badge.style.display = ruim > 0 ? 'inline' : 'none';

  document.getElementById('manutStats').innerHTML = `
    <div class="stat-card blue"><div class="stat-label">Total Sistemas</div><div class="stat-value">${manutencoes.length}</div></div>
    <div class="stat-card green"><div class="stat-label">Bom</div><div class="stat-value">${bom}</div></div>
    <div class="stat-card yellow"><div class="stat-label">Atenção</div><div class="stat-value">${atencao}</div></div>
    <div class="stat-card red"><div class="stat-label">Ruim</div><div class="stat-value">${ruim}</div></div>`;

  const icons = {'Ar Condicionado':'❄️','Elevador':'🛗','Elétric':'⚡','Hidr':'💧','Gerador':'🔋','CFTV':'📹','Segurança':'📹','Incêndio':'🔥','Rede':'🌐','TI':'🌐'};
  const colors = {'Ar Condicionado':'#3b82f6','Elevador':'#a855f7','Elétric':'#eab308','Hidr':'#06b6d4','Gerador':'#22c55e','CFTV':'#f97316','Segurança':'#f97316','Incêndio':'#ef4444','Rede':'#8b5cf6','TI':'#8b5cf6'};
  const getIcon = n => { for (const [k,v] of Object.entries(icons)) if (n.includes(k)) return v; return '🔧'; };
  const getColor = n => { for (const [k,v] of Object.entries(colors)) if (n.includes(k)) return v; return '#64748b'; };
  const statusClass = {'Bom':'status-bom','Atenção':'status-atencao','Ruim':'status-ruim'};

  tbody.innerHTML = manutencoes.length === 0
    ? '<tr><td colspan="5" style="text-align:center;padding:2rem;color:var(--text-muted)">Nenhuma manutenção cadastrada</td></tr>'
    : manutencoes.map(m => `<tr>
        <td><div class="system-name"><div class="system-icon" style="background:${getColor(m.sistema)}22;color:${getColor(m.sistema)}">${getIcon(m.sistema)}</div>${escapeHtml(m.sistema)}</div></td>
        <td class="date-cell">${formatDate(m.ultima_manutencao)}</td>
        <td><span class="status-badge ${statusClass[m.status]||''}"><span class="status-dot"></span>${m.status}</span></td>
        <td><div class="obs-text">${escapeHtml(m.observacao)||'—'}</div></td>
        <td class="date-cell">${formatDate(m.proxima_manutencao)}</td>
      </tr>`).join('');

  document.getElementById('lastUpdate').textContent = `Atualizado: ${new Date().toLocaleTimeString('pt-BR')}`;
}

function renderObras() {
  const grid = document.getElementById('obrasGrid');
  const total = obras.length;
  const concluidas = obras.filter(o => o.fase === 'Concluída').length;
  const emAndamento = obras.filter(o => !['Concluída','Planejamento'].includes(o.fase)).length;
  const planej = obras.filter(o => o.fase === 'Planejamento').length;

  document.getElementById('obrasStats').innerHTML = `
    <div class="stat-card blue"><div class="stat-label">Total Obras</div><div class="stat-value">${total}</div></div>
    <div class="stat-card green"><div class="stat-label">Concluídas</div><div class="stat-value">${concluidas}</div></div>
    <div class="stat-card yellow"><div class="stat-label">Em Andamento</div><div class="stat-value">${emAndamento}</div></div>
    <div class="stat-card red"><div class="stat-label">Planejamento</div><div class="stat-value">${planej}</div></div>`;

  const phaseClass = {'Fundação':'phase-fundacao','Estrutura':'phase-estrutura','Acabamento':'phase-acabamento','Concluída':'phase-concluida','Planejamento':'phase-planejamento'};
  const pColor = p => p >= 80 ? 'var(--green)' : p >= 50 ? 'var(--accent)' : p >= 25 ? 'var(--yellow)' : 'var(--red)';

  grid.innerHTML = obras.length === 0
    ? '<div style="text-align:center;padding:2rem;color:var(--text-muted)">Nenhuma obra cadastrada</div>'
    : obras.map(o => `<div class="obra-card">
        <div class="obra-header"><div><div class="obra-name">${escapeHtml(o.nome)}</div><div class="obra-location">📍 ${escapeHtml(o.localizacao)||'Local não informado'}</div></div><span class="obra-phase-badge ${phaseClass[o.fase]||''}">${o.fase}</span></div>
        <div class="progress-section"><div class="progress-info"><span class="progress-label">Progresso Geral</span><span class="progress-value" style="color:${pColor(o.progresso)}">${o.progresso}%</span></div><div class="progress-bar"><div class="progress-fill" style="width:${o.progresso}%;background:${pColor(o.progresso)}"></div></div></div>
        ${o.observacao?`<div style="font-size:0.82rem;color:var(--text-secondary);margin-top:0.6rem;line-height:1.5;">💬 ${escapeHtml(o.observacao)}</div>`:''}
        <div class="obra-details">
          <div class="obra-detail-item"><div class="obra-detail-label">Início</div><div class="obra-detail-value">${formatDate(o.data_inicio)}</div></div>
          <div class="obra-detail-item"><div class="obra-detail-label">Previsão Entrega</div><div class="obra-detail-value">${formatDate(o.previsao_entrega)}</div></div>
          <div class="obra-detail-item"><div class="obra-detail-label">Responsável</div><div class="obra-detail-value">${escapeHtml(o.responsavel)||'—'}</div></div>
          <div class="obra-detail-item"><div class="obra-detail-label">Fase Atual</div><div class="obra-detail-value">${o.fase}</div></div>
        </div></div>`).join('');
}

async function loadAll() {
  try {
    [manutencoes, obras] = await Promise.all([apiCall('manutencoes'), apiCall('obras')]);
    renderManut(); renderObras(); showSync();
  } catch (err) { console.error('Erro ao carregar:', err); }
}

setInterval(loadAll, 30000);
loadAll();
</script>
</body>
</html>
