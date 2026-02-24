<!DOCTYPE html>
<html lang="pt-BR">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Administração — Arena </title>
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
  }

  * { margin: 0; padding: 0; box-sizing: border-box; }

  body {
    font-family: 'DM Sans', sans-serif;
    background: var(--bg-primary);
    color: var(--text-primary);
    min-height: 100vh;
  }

  /* === HEADER === */
  .header {
    background: linear-gradient(135deg, var(--bg-secondary) 0%, #0f172a 100%);
    border-bottom: 1px solid var(--border);
    padding: 1.2rem 2.5rem;
    display: flex; justify-content: space-between; align-items: center;
    position: sticky; top: 0; z-index: 100; backdrop-filter: blur(20px);
  }

  .header-left { display: flex; align-items: center; gap: 1.2rem; }
  .logo-icon { height: 44px; display: flex; align-items: center; flex-shrink: 0; }
  .logo-icon img { height: 40px; width: auto; object-fit: contain; filter: brightness(1.1); }

  .header-title {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.5rem; font-weight: 700;
    background: linear-gradient(135deg, #f1f5f9, #94a3b8);
    -webkit-background-clip: text; -webkit-text-fill-color: transparent;
  }

  .header-subtitle { font-size: 0.78rem; color: var(--text-muted); letter-spacing: 0.5px; }

  .btn-dashboard {
    padding: 0.6rem 1.4rem; border-radius: 10px;
    font-family: 'DM Sans', sans-serif; font-size: 0.85rem; font-weight: 600;
    color: var(--accent); background: var(--accent-glow);
    border: 1px solid rgba(59,130,246,0.3);
    cursor: pointer; transition: all 0.3s; text-decoration: none;
    display: flex; align-items: center; gap: 0.5rem;
  }

  .btn-dashboard:hover { background: rgba(59,130,246,0.25); transform: translateY(-1px); }

  /* === TABS === */
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
  .tab.active { background: var(--accent-glow); color: var(--accent); border-color: rgba(59,130,246,0.3); }
  .tab-icon { font-size: 1.1rem; }

  /* === MAIN === */
  .main { padding: 1.5rem 2.5rem 2rem; max-width: 1400px; margin: 0 auto; }
  .tab-content { display: none; animation: fadeIn 0.4s ease; }
  .tab-content.active { display: block; }
  @keyframes fadeIn { from { opacity: 0; transform: translateY(10px); } to { opacity: 1; transform: translateY(0); } }

  /* === LAYOUT === */
  .admin-section {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 1.5rem;
  }

  /* === FORM === */
  .form-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 16px; padding: 1.8rem;
  }

  .form-card-title {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.15rem; font-weight: 700;
    margin-bottom: 1.5rem; display: flex; align-items: center; gap: 0.6rem;
  }

  .form-group { margin-bottom: 1.2rem; }

  .form-label {
    display: block; font-size: 0.78rem; color: var(--text-muted);
    text-transform: uppercase; letter-spacing: 0.8px; font-weight: 600; margin-bottom: 0.5rem;
  }

  .form-input, .form-select, .form-textarea {
    width: 100%; padding: 0.75rem 1rem;
    background: rgba(0,0,0,0.3); border: 1px solid var(--border);
    border-radius: 10px; color: var(--text-primary);
    font-family: 'DM Sans', sans-serif; font-size: 0.9rem;
    transition: all 0.3s; outline: none;
  }

  .form-input:focus, .form-select:focus, .form-textarea:focus {
    border-color: var(--accent); box-shadow: 0 0 0 3px rgba(59,130,246,0.15);
  }

  .form-select { cursor: pointer; }
  .form-select option { background: var(--bg-secondary); color: var(--text-primary); }
  .form-textarea { resize: vertical; min-height: 80px; }
  .form-row { display: grid; grid-template-columns: 1fr 1fr; gap: 1rem; }

  .btn {
    padding: 0.8rem 2rem; border-radius: 10px;
    font-family: 'DM Sans', sans-serif; font-size: 0.9rem; font-weight: 600;
    cursor: pointer; border: none; transition: all 0.3s;
    display: inline-flex; align-items: center; gap: 0.5rem;
  }

  .btn:disabled { opacity: 0.5; cursor: not-allowed; }

  .btn-primary {
    background: linear-gradient(135deg, var(--accent), #6366f1);
    color: white; box-shadow: 0 4px 15px rgba(59,130,246,0.3);
  }

  .btn-primary:hover:not(:disabled) { transform: translateY(-1px); box-shadow: 0 6px 20px rgba(59,130,246,0.4); }

  .btn-secondary {
    background: rgba(100,116,139,0.15); color: var(--text-secondary);
    border: 1px solid var(--border);
  }

  .btn-secondary:hover { background: rgba(100,116,139,0.25); }

  .btn-danger { background: rgba(239,68,68,0.15); color: var(--red); border: 1px solid rgba(239,68,68,0.3); }
  .btn-danger:hover { background: rgba(239,68,68,0.25); }

  .btn-group { display: flex; gap: 0.8rem; margin-top: 0.5rem; }

  /* === LIST === */
  .records-card {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 16px; padding: 1.8rem; max-height: 600px; overflow-y: auto;
  }

  .records-title {
    font-family: 'Plus Jakarta Sans', sans-serif; font-size: 1.05rem; font-weight: 700;
    margin-bottom: 1rem; color: var(--text-secondary);
    display: flex; align-items: center; gap: 0.5rem;
  }

  .record-count {
    background: var(--accent-glow); color: var(--accent);
    padding: 0.15rem 0.6rem; border-radius: 20px;
    font-size: 0.72rem; font-weight: 700;
  }

  .record-item {
    display: flex; justify-content: space-between; align-items: center;
    padding: 0.8rem 1rem; border-radius: 10px;
    border: 1px solid var(--border); margin-bottom: 0.5rem;
    transition: all 0.2s;
  }

  .record-item:hover { background: rgba(255,255,255,0.02); border-color: rgba(255,255,255,0.1); }

  .record-info { flex: 1; min-width: 0; }

  .record-name {
    font-weight: 600; color: var(--text-primary);
    white-space: nowrap; overflow: hidden; text-overflow: ellipsis;
    font-size: 0.9rem;
  }

  .record-meta { font-size: 0.75rem; color: var(--text-muted); margin-top: 0.2rem; }

  .record-status {
    display: inline-block; width: 8px; height: 8px; border-radius: 50%; margin-right: 0.4rem;
  }

  .record-actions { display: flex; gap: 0.4rem; flex-shrink: 0; margin-left: 0.8rem; }

  .btn-icon {
    width: 32px; height: 32px; border-radius: 8px;
    display: flex; align-items: center; justify-content: center;
    cursor: pointer; border: none; font-size: 0.85rem; transition: all 0.2s;
  }

  .btn-icon-edit { background: var(--blue-bg); color: var(--accent); border: 1px solid var(--blue-border); }
  .btn-icon-edit:hover { background: rgba(59,130,246,0.25); }
  .btn-icon-del { background: var(--red-bg); color: var(--red); border: 1px solid rgba(239,68,68,0.25); }
  .btn-icon-del:hover { background: rgba(239,68,68,0.25); }

  .empty-state {
    text-align: center; padding: 2rem; color: var(--text-muted); font-size: 0.85rem;
  }

  /* === TOAST === */
  .toast {
    position: fixed; bottom: 2rem; right: 2rem;
    padding: 1rem 1.5rem; border-radius: 12px;
    font-weight: 600; font-size: 0.9rem; z-index: 1000;
    transform: translateY(100px); opacity: 0; transition: all 0.4s ease;
    display: flex; align-items: center; gap: 0.6rem;
  }

  .toast.show { transform: translateY(0); opacity: 1; }
  .toast-success { background: var(--green-bg); color: var(--green); border: 1px solid var(--green-border); }
  .toast-error { background: var(--red-bg); color: var(--red); border: 1px solid rgba(239,68,68,0.3); }

  /* === MODAL === */
  .modal-overlay {
    position: fixed; inset: 0; background: rgba(0,0,0,0.7);
    backdrop-filter: blur(5px); z-index: 500;
    display: none; align-items: center; justify-content: center;
  }

  .modal-overlay.active { display: flex; }

  .modal {
    background: var(--bg-card); border: 1px solid var(--border);
    border-radius: 18px; padding: 2rem; max-width: 450px; width: 90%;
    animation: modalIn 0.3s ease;
  }

  @keyframes modalIn { from { transform: scale(0.95); opacity: 0; } to { transform: scale(1); opacity: 1; } }

  .modal h3 { font-family: 'Plus Jakarta Sans', sans-serif; margin-bottom: 0.8rem; }
  .modal p { color: var(--text-secondary); margin-bottom: 1.5rem; font-size: 0.9rem; }
  .modal .btn-group { justify-content: flex-end; }

  .loading-spinner {
    display: inline-block; width: 16px; height: 16px;
    border: 2px solid rgba(255,255,255,0.2); border-top-color: white;
    border-radius: 50%; animation: spin 0.8s linear infinite;
  }

  @keyframes spin { to { transform: rotate(360deg); } }

  /* === RESPONSIVE === */
  @media (max-width: 1024px) {
    .admin-section { grid-template-columns: 1fr; }
  }

  @media (max-width: 768px) {
    .header { padding: 1rem 1.2rem; }
    .main { padding: 1rem 1.2rem; }
    .tabs { padding: 0.8rem 1.2rem; overflow-x: auto; }
    .tab { padding: 0.6rem 1.2rem; font-size: 0.82rem; white-space: nowrap; }
    .form-row { grid-template-columns: 1fr; }
    .header-title { font-size: 1.1rem; }
  }

  ::-webkit-scrollbar { width: 6px; }
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
      <div class="header-subtitle">PAINEL DE ADMINISTRAÇÃO</div>
    </div>
  </div>
  <a href="index.php" class="btn-dashboard">📊 Ver Dashboard</a>
</header>

<nav class="tabs">
  <div class="tab active" data-tab="manutencao"><span class="tab-icon">🔧</span> Manutenções</div>
  <div class="tab" data-tab="obras"><span class="tab-icon">🏗️</span> Obras</div>
</nav>

<main class="main">

  <!-- ===== MANUTENÇÕES ===== -->
  <div class="tab-content active" id="tab-manutencao">
    <div class="admin-section">
      <div class="form-card">
        <div class="form-card-title">🔧 <span id="formManutTitle">Cadastrar Manutenção</span></div>
        <form id="formManut">
          <input type="hidden" id="m_id">
          <div class="form-group">
            <label class="form-label">Sistema *</label>
            <input class="form-input" id="m_sistema" placeholder="Ex: Ar Condicionado Central" required>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Última Manutenção *</label>
              <input class="form-input" type="date" id="m_ultima" required>
            </div>
            <div class="form-group">
              <label class="form-label">Próxima Manutenção *</label>
              <input class="form-input" type="date" id="m_proxima" required>
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Status *</label>
            <select class="form-select" id="m_status" required>
              <option value="">Selecione...</option>
              <option value="Bom">✅ Bom</option>
              <option value="Atenção">⚠️ Atenção</option>
              <option value="Ruim">🔴 Ruim</option>
            </select>
          </div>
          <div class="form-group">
            <label class="form-label">Observação</label>
            <textarea class="form-textarea" id="m_obs" placeholder="Detalhes sobre a manutenção..."></textarea>
          </div>
          <div class="btn-group">
            <button type="submit" class="btn btn-primary" id="btnSaveManut">💾 Salvar</button>
            <button type="button" class="btn btn-secondary" id="btnCancelManut" style="display:none" onclick="cancelEditManut()">✕ Cancelar</button>
          </div>
        </form>
      </div>
      <div class="records-card">
        <div class="records-title">📋 Registros <span class="record-count" id="manutCount">0</span></div>
        <div id="manutList"></div>
      </div>
    </div>
  </div>

  <!-- ===== OBRAS ===== -->
  <div class="tab-content" id="tab-obras">
    <div class="admin-section">
      <div class="form-card">
        <div class="form-card-title">🏗️ <span id="formObraTitle">Cadastrar Obra</span></div>
        <form id="formObra">
          <input type="hidden" id="o_id">
          <div class="form-group">
            <label class="form-label">Nome da Obra *</label>
            <input class="form-input" id="o_nome" placeholder="Ex: Edifício Comercial Tower" required>
          </div>
          <div class="form-group">
            <label class="form-label">Localização</label>
            <input class="form-input" id="o_local" placeholder="Ex: Av. Paulista, São Paulo - SP">
          </div>
          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Fase *</label>
              <select class="form-select" id="o_fase" required>
                <option value="">Selecione...</option>
                <option value="Planejamento">Planejamento</option>
                <option value="Fundação">Fundação</option>
                <option value="Estrutura">Estrutura</option>
                <option value="Acabamento">Acabamento</option>
                <option value="Concluída">Concluída</option>
              </select>
            </div>
            <div class="form-group">
              <label class="form-label">Progresso (%) *</label>
              <input class="form-input" type="number" id="o_progresso" min="0" max="100" placeholder="0-100" required>
            </div>
          </div>
          <div class="form-row">
            <div class="form-group">
              <label class="form-label">Início</label>
              <input class="form-input" type="date" id="o_inicio">
            </div>
            <div class="form-group">
              <label class="form-label">Previsão de Entrega</label>
              <input class="form-input" type="date" id="o_entrega">
            </div>
          </div>
          <div class="form-group">
            <label class="form-label">Responsável</label>
            <input class="form-input" id="o_responsavel" placeholder="Ex: Eng. Carlos Silva">
          </div>
          <div class="form-group">
            <label class="form-label">Observação</label>
            <textarea class="form-textarea" id="o_obs" placeholder="Notas sobre a obra..."></textarea>
          </div>
          <div class="btn-group">
            <button type="submit" class="btn btn-primary" id="btnSaveObra">💾 Salvar</button>
            <button type="button" class="btn btn-secondary" id="btnCancelObra" style="display:none" onclick="cancelEditObra()">✕ Cancelar</button>
          </div>
        </form>
      </div>
      <div class="records-card">
        <div class="records-title">📋 Obras Cadastradas <span class="record-count" id="obrasCount">0</span></div>
        <div id="obrasList"></div>
      </div>
    </div>
  </div>

</main>

<div class="toast" id="toast"></div>

<div class="modal-overlay" id="deleteModal">
  <div class="modal">
    <h3>⚠️ Confirmar Exclusão</h3>
    <p id="deleteMsg">Deseja realmente excluir este registro?</p>
    <div class="btn-group">
      <button class="btn btn-danger" id="btnConfirmDelete">🗑️ Excluir</button>
      <button class="btn btn-secondary" onclick="closeModal()">Cancelar</button>
    </div>
  </div>
</div>

<script>
const API = 'api.php';
let manutencoes = [], obras = [], deleteTarget = null;

// === API ===
async function apiCall(resource, method = 'GET', id = null, data = null) {
  let url = `${API}?resource=${resource}`;
  if (id) url += `&id=${id}`;
  const opts = { method, headers: { 'Content-Type': 'application/json' } };
  if (data && (method === 'POST' || method === 'PUT')) opts.body = JSON.stringify(data);
  const res = await fetch(url, opts);
  const json = await res.json();
  if (!res.ok) throw new Error(json.error || 'Erro na requisição');
  return json;
}

// === TABS ===
document.querySelectorAll('.tab').forEach(tab => {
  tab.addEventListener('click', () => {
    document.querySelectorAll('.tab').forEach(t => t.classList.remove('active'));
    document.querySelectorAll('.tab-content').forEach(c => c.classList.remove('active'));
    tab.classList.add('active');
    document.getElementById('tab-' + tab.dataset.tab).classList.add('active');
  });
});

// === HELPERS ===
function formatDate(d) { if (!d) return '—'; const [y, m, day] = d.split('-'); return `${day}/${m}/${y}`; }
function escapeHtml(str) { if (!str) return ''; const div = document.createElement('div'); div.textContent = str; return div.innerHTML; }

function showToast(msg, type = 'success') {
  const t = document.getElementById('toast');
  t.className = `toast toast-${type} show`;
  t.innerHTML = `${type === 'success' ? '✅' : '❌'} ${escapeHtml(msg)}`;
  setTimeout(() => t.classList.remove('show'), 3000);
}

// === RENDER MANUTENÇÕES LIST ===
function renderManutList() {
  document.getElementById('manutCount').textContent = manutencoes.length;
  const list = document.getElementById('manutList');

  if (manutencoes.length === 0) {
    list.innerHTML = '<div class="empty-state">Nenhuma manutenção cadastrada ainda.</div>';
    return;
  }

  const statusColors = { 'Bom': 'var(--green)', 'Atenção': 'var(--yellow)', 'Ruim': 'var(--red)' };

  list.innerHTML = manutencoes.map(m => `
    <div class="record-item">
      <div class="record-info">
        <div class="record-name"><span class="record-status" style="background:${statusColors[m.status]||'#666'}"></span>${escapeHtml(m.sistema)}</div>
        <div class="record-meta">${m.status} · Última: ${formatDate(m.ultima_manutencao)} · Próxima: ${formatDate(m.proxima_manutencao)}</div>
      </div>
      <div class="record-actions">
        <button class="btn-icon btn-icon-edit" onclick="editManut(${m.id})" title="Editar">✏️</button>
        <button class="btn-icon btn-icon-del" onclick="deleteManut(${m.id}, '${escapeHtml(m.sistema)}')" title="Excluir">🗑️</button>
      </div>
    </div>
  `).join('');
}

// === RENDER OBRAS LIST ===
function renderObrasList() {
  document.getElementById('obrasCount').textContent = obras.length;
  const list = document.getElementById('obrasList');

  if (obras.length === 0) {
    list.innerHTML = '<div class="empty-state">Nenhuma obra cadastrada ainda.</div>';
    return;
  }

  list.innerHTML = obras.map(o => `
    <div class="record-item">
      <div class="record-info">
        <div class="record-name">${escapeHtml(o.nome)}</div>
        <div class="record-meta">${o.fase} · ${o.progresso}% · ${escapeHtml(o.responsavel) || 'Sem responsável'}</div>
      </div>
      <div class="record-actions">
        <button class="btn-icon btn-icon-edit" onclick="editObra(${o.id})" title="Editar">✏️</button>
        <button class="btn-icon btn-icon-del" onclick="deleteObra(${o.id}, '${escapeHtml(o.nome)}')" title="Excluir">🗑️</button>
      </div>
    </div>
  `).join('');
}

// === LOAD ALL ===
async function loadAll() {
  try {
    [manutencoes, obras] = await Promise.all([apiCall('manutencoes'), apiCall('obras')]);
    renderManutList();
    renderObrasList();
  } catch (err) {
    showToast('Erro ao carregar dados: ' + err.message, 'error');
  }
}

// === CRUD MANUTENÇÃO ===
document.getElementById('formManut').addEventListener('submit', async (e) => {
  e.preventDefault();
  const btn = document.getElementById('btnSaveManut');
  btn.disabled = true;
  btn.innerHTML = '<span class="loading-spinner"></span> Salvando...';

  const id = document.getElementById('m_id').value;
  const data = {
    sistema: document.getElementById('m_sistema').value,
    ultima_manutencao: document.getElementById('m_ultima').value,
    status: document.getElementById('m_status').value,
    observacao: document.getElementById('m_obs').value,
    proxima_manutencao: document.getElementById('m_proxima').value,
  };

  try {
    if (id) {
      await apiCall('manutencoes', 'PUT', id, data);
      showToast('Manutenção atualizada com sucesso!');
    } else {
      await apiCall('manutencoes', 'POST', null, data);
      showToast('Manutenção cadastrada com sucesso!');
    }
    cancelEditManut();
    await loadAll();
  } catch (err) { showToast('Erro: ' + err.message, 'error'); }

  btn.disabled = false;
  btn.innerHTML = '💾 Salvar';
});

function editManut(id) {
  const m = manutencoes.find(x => x.id == id);
  if (!m) return;
  document.getElementById('m_id').value = m.id;
  document.getElementById('m_sistema').value = m.sistema;
  document.getElementById('m_ultima').value = m.ultima_manutencao;
  document.getElementById('m_status').value = m.status;
  document.getElementById('m_obs').value = m.observacao || '';
  document.getElementById('m_proxima').value = m.proxima_manutencao;
  document.getElementById('formManutTitle').textContent = 'Editar Manutenção';
  document.getElementById('btnCancelManut').style.display = 'inline-flex';
  document.getElementById('m_sistema').focus();
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function cancelEditManut() {
  document.getElementById('formManut').reset();
  document.getElementById('m_id').value = '';
  document.getElementById('formManutTitle').textContent = 'Cadastrar Manutenção';
  document.getElementById('btnCancelManut').style.display = 'none';
}

function deleteManut(id, nome) {
  deleteTarget = { type: 'manutencoes', id };
  document.getElementById('deleteMsg').textContent = `Deseja excluir a manutenção "${nome}"?`;
  document.getElementById('deleteModal').classList.add('active');
}

// === CRUD OBRAS ===
document.getElementById('formObra').addEventListener('submit', async (e) => {
  e.preventDefault();
  const btn = document.getElementById('btnSaveObra');
  btn.disabled = true;
  btn.innerHTML = '<span class="loading-spinner"></span> Salvando...';

  const id = document.getElementById('o_id').value;
  const data = {
    nome: document.getElementById('o_nome').value,
    localizacao: document.getElementById('o_local').value,
    fase: document.getElementById('o_fase').value,
    progresso: parseInt(document.getElementById('o_progresso').value),
    data_inicio: document.getElementById('o_inicio').value,
    previsao_entrega: document.getElementById('o_entrega').value,
    responsavel: document.getElementById('o_responsavel').value,
    observacao: document.getElementById('o_obs').value,
  };

  try {
    if (id) {
      await apiCall('obras', 'PUT', id, data);
      showToast('Obra atualizada com sucesso!');
    } else {
      await apiCall('obras', 'POST', null, data);
      showToast('Obra cadastrada com sucesso!');
    }
    cancelEditObra();
    await loadAll();
  } catch (err) { showToast('Erro: ' + err.message, 'error'); }

  btn.disabled = false;
  btn.innerHTML = '💾 Salvar';
});

function editObra(id) {
  const o = obras.find(x => x.id == id);
  if (!o) return;
  document.getElementById('o_id').value = o.id;
  document.getElementById('o_nome').value = o.nome;
  document.getElementById('o_local').value = o.localizacao || '';
  document.getElementById('o_fase').value = o.fase;
  document.getElementById('o_progresso').value = o.progresso;
  document.getElementById('o_inicio').value = o.data_inicio || '';
  document.getElementById('o_entrega').value = o.previsao_entrega || '';
  document.getElementById('o_responsavel').value = o.responsavel || '';
  document.getElementById('o_obs').value = o.observacao || '';
  document.getElementById('formObraTitle').textContent = 'Editar Obra';
  document.getElementById('btnCancelObra').style.display = 'inline-flex';
  // Switch to obras tab
  document.querySelectorAll('.tab')[1].click();
  document.getElementById('o_nome').focus();
  window.scrollTo({ top: 0, behavior: 'smooth' });
}

function cancelEditObra() {
  document.getElementById('formObra').reset();
  document.getElementById('o_id').value = '';
  document.getElementById('formObraTitle').textContent = 'Cadastrar Obra';
  document.getElementById('btnCancelObra').style.display = 'none';
}

function deleteObra(id, nome) {
  deleteTarget = { type: 'obras', id };
  document.getElementById('deleteMsg').textContent = `Deseja excluir a obra "${nome}"?`;
  document.getElementById('deleteModal').classList.add('active');
}

// === MODAL DELETE ===
document.getElementById('btnConfirmDelete').addEventListener('click', async () => {
  if (!deleteTarget) return;
  const btn = document.getElementById('btnConfirmDelete');
  btn.disabled = true;
  btn.innerHTML = '<span class="loading-spinner"></span> Excluindo...';

  try {
    await apiCall(deleteTarget.type, 'DELETE', deleteTarget.id);
    showToast('Registro excluído com sucesso!');
    closeModal();
    await loadAll();
  } catch (err) { showToast('Erro ao excluir: ' + err.message, 'error'); }

  btn.disabled = false;
  btn.innerHTML = '🗑️ Excluir';
});

function closeModal() {
  document.getElementById('deleteModal').classList.remove('active');
  deleteTarget = null;
}

// === INIT ===
loadAll();
</script>
</body>
</html>
