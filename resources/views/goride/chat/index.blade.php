@extends('goride.layouts.dashboard')
@section('title', 'Messages | GoRide')
@section('css')
<style>
  .chat-container { display: flex; height: calc(100vh - 120px); background: #fff; border-radius: 12px; overflow: hidden; box-shadow: 0 2px 12px rgba(0,0,0,0.08); }
  .chat-sidebar { width: 340px; border-right: 1px solid #e5e7eb; display: flex; flex-direction: column; }
  .chat-sidebar-header { padding: 16px; border-bottom: 1px solid #e5e7eb; display: flex; justify-content: space-between; align-items: center; }
  .chat-sidebar-header h3 { margin: 0; font-size: 18px; font-weight: 700; color: #1a1a2e; }
  .chat-search { padding: 12px 16px; border-bottom: 1px solid #f3f4f6; }
  .chat-search input { width: 100%; padding: 10px 14px; border: 1px solid #e5e7eb; border-radius: 10px; font-size: 14px; outline: none; background: #f9fafb; }
  .chat-search input:focus { border-color: #10713C; background: #fff; }
  .chat-list { flex: 1; overflow-y: auto; }
  .chat-list-item { display: flex; align-items: center; padding: 14px 16px; border-bottom: 1px solid #f3f4f6; cursor: pointer; transition: background 0.15s; }
  .chat-list-item:hover { background: #f9fafb; }
  .chat-list-item.active { background: #f0fdf4; border-left: 3px solid #10713C; }
  .chat-avatar { width: 48px; height: 48px; border-radius: 50%; background: linear-gradient(135deg, #10713C, #1D9755); display: flex; align-items: center; justify-content: center; color: #fff; font-weight: 700; font-size: 18px; margin-right: 12px; flex-shrink: 0; overflow: hidden; }
  .chat-avatar img { width: 100%; height: 100%; object-fit: cover; }
  .chat-list-info { flex: 1; min-width: 0; }
  .chat-list-name { font-weight: 600; font-size: 15px; color: #1a1a2e; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; }
  .chat-list-preview { font-size: 13px; color: #6b7280; white-space: nowrap; overflow: hidden; text-overflow: ellipsis; margin-top: 2px; }
  .chat-list-meta { text-align: right; flex-shrink: 0; }
  .chat-list-time { font-size: 11px; color: #9ca3af; }
  .chat-list-badge { display: inline-block; background: #10713C; color: #fff; font-size: 11px; font-weight: 700; padding: 2px 7px; border-radius: 10px; margin-top: 4px; min-width: 18px; text-align: center; }
  .chat-main { flex: 1; display: flex; flex-direction: column; }
  .chat-main-header { padding: 14px 20px; border-bottom: 1px solid #e5e7eb; display: flex; align-items: center; }
  .chat-main-header h4 { margin: 0; font-size: 16px; font-weight: 600; }
  .chat-messages { flex: 1; overflow-y: auto; padding: 20px; background: #f9fafb; display: flex; flex-direction: column-reverse; }
  .msg-row { display: flex; margin-bottom: 12px; }
  .msg-row.sent { justify-content: flex-end; }
  .msg-row.received { justify-content: flex-start; }
  .msg-bubble { max-width: 65%; padding: 10px 16px; border-radius: 18px; font-size: 14px; line-height: 1.4; word-wrap: break-word; }
  .msg-row.sent .msg-bubble { background: #10713C; color: #fff; border-bottom-right-radius: 4px; }
  .msg-row.received .msg-bubble { background: #fff; color: #1a1a2e; border-bottom-left-radius: 4px; box-shadow: 0 1px 3px rgba(0,0,0,0.08); }
  .msg-time { font-size: 10px; margin-top: 4px; opacity: 0.7; }
  .msg-row.sent .msg-time { text-align: right; }
  .chat-input-area { padding: 14px 20px; border-top: 1px solid #e5e7eb; background: #fff; display: flex; align-items: center; gap: 10px; }
  .chat-input-area input { flex: 1; padding: 12px 16px; border: 1px solid #e5e7eb; border-radius: 24px; font-size: 14px; outline: none; }
  .chat-input-area input:focus { border-color: #10713C; }
  .chat-send-btn { width: 44px; height: 44px; border-radius: 50%; background: #10713C; color: #fff; border: none; cursor: pointer; display: flex; align-items: center; justify-content: center; font-size: 18px; transition: background 0.15s; }
  .chat-send-btn:hover { background: #0a5a2f; }
  .chat-empty { display: flex; flex-direction: column; align-items: center; justify-content: center; height: 100%; color: #9ca3af; }
  .chat-empty i { font-size: 64px; margin-bottom: 16px; }
  .chat-empty p { font-size: 16px; }
  .new-chat-btn { background: #10713C; color: #fff; border: none; padding: 8px 16px; border-radius: 8px; font-size: 13px; font-weight: 600; cursor: pointer; display: flex; align-items: center; gap: 6px; }
  .new-chat-btn:hover { background: #0a5a2f; }
  @media (max-width: 768px) {
    .chat-sidebar { width: 100%; }
    .chat-main { display: none; }
    .chat-container.chat-open .chat-sidebar { display: none; }
    .chat-container.chat-open .chat-main { display: flex; }
  }
</style>
@endsection
@section('content')
<div class="chat-container" id="chatContainer">
  <div class="chat-sidebar">
    <div class="chat-sidebar-header">
      <h3>Messages</h3>
      <button class="new-chat-btn" onclick="startNewChat()"><i class="fas fa-plus"></i> New</button>
    </div>
    <div class="chat-search">
      <input type="text" placeholder="Search conversations..." id="chatSearch" oninput="filterConversations()">
    </div>
    <div class="chat-list" id="chatList">
      <div style="text-align:center;padding:40px;color:#9ca3af;">
        <i class="fas fa-spinner fa-spin" style="font-size:24px;"></i>
        <p style="margin-top:8px;">Loading...</p>
      </div>
    </div>
  </div>
  <div class="chat-main" id="chatMain">
    <div class="chat-empty" id="chatEmpty">
      <i class="fas fa-comments"></i>
      <p>Select a conversation to start messaging</p>
    </div>
  </div>
</div>
@endsection
@section('js')
<script>
const API_BASE = '/api/chat';
let conversations = [];
let activeConversationId = null;
let pollTimer = null;
let lastMessageId = 0;
const authUserId = {{ auth()->id() }};

async function loadConversations() {
  try {
    const res = await fetch(`${API_BASE}/conversations`, { headers: { 'Authorization': `Bearer ${localStorage.getItem('token') || ''}`, 'Accept': 'application/json' } });
    const data = await res.json();
    if (data.success) {
      conversations = data.conversations.data || [];
      renderConversations();
    }
  } catch (e) { console.error('Failed to load conversations:', e); }
}

function renderConversations() {
  const list = document.getElementById('chatList');
  const search = document.getElementById('chatSearch').value.toLowerCase();
  const filtered = conversations.filter(c => {
    const name = (c.other_user?.name || c.title || 'Chat').toLowerCase();
    return !search || name.includes(search);
  });
  if (filtered.length === 0) {
    list.innerHTML = '<div style="text-align:center;padding:40px;color:#9ca3af;"><i class="fas fa-comment-slash" style="font-size:32px;"></i><p style="margin-top:8px;">No conversations</p></div>';
    return;
  }
  list.innerHTML = filtered.map(c => {
    const name = c.other_user?.name || c.title || 'Chat';
    const avatar = c.other_user?.image || '';
    const initial = name.charAt(0).toUpperCase();
    const preview = c.latest_message?.message || 'No messages yet';
    const time = c.last_message_at ? formatTime(c.last_message_at) : '';
    const badge = c.unread_count > 0 ? `<div class="chat-list-badge">${c.unread_count}</div>` : '';
    const active = c.id === activeConversationId ? 'active' : '';
    return `<div class="chat-list-item ${active}" onclick="openConversation(${c.id}, '${name.replace(/'/g, "\\'")}')">
      <div class="chat-avatar">${avatar ? `<img src="${avatar}" alt="">` : initial}</div>
      <div class="chat-list-info">
        <div class="chat-list-name">${name}</div>
        <div class="chat-list-preview">${preview}</div>
      </div>
      <div class="chat-list-meta">
        <div class="chat-list-time">${time}</div>
        ${badge}
      </div>
    </div>`;
  }).join('');
}

function formatTime(iso) {
  const d = new Date(iso);
  const now = new Date();
  const diff = (now - d) / 1000;
  if (diff < 60) return 'Now';
  if (diff < 3600) return Math.floor(diff / 60) + 'm';
  if (diff < 86400) return Math.floor(diff / 3600) + 'h';
  if (diff < 604800) return Math.floor(diff / 86400) + 'd';
  return d.toLocaleDateString();
}

async function openConversation(id, name) {
  activeConversationId = id;
  lastMessageId = 0;
  renderConversations();
  document.getElementById('chatEmpty').style.display = 'none';
  const main = document.getElementById('chatMain');
  main.innerHTML = `<div class="chat-main-header">
    <button onclick="backToList()" style="background:none;border:none;font-size:20px;cursor:pointer;margin-right:12px;color:#10713C;" class="mobile-back"><i class="fas fa-arrow-left"></i></button>
    <h4>${name}</h4>
  </div>
  <div class="chat-messages" id="chatMessages"></div>
  <div class="chat-input-area">
    <input type="text" id="messageInput" placeholder="Type a message..." onkeydown="if(event.key==='Enter')sendMessage()">
    <button class="chat-send-btn" onclick="sendMessage()"><i class="fas fa-paper-plane"></i></button>
  </div>`;
  main.style.display = 'flex';
  document.getElementById('chatEmpty').style.display = 'none';
  if (pollTimer) clearInterval(pollTimer);
  await loadMessages(id);
  pollTimer = setInterval(() => pollMessages(id), 3000);
}

function backToList() {
  activeConversationId = null;
  if (pollTimer) clearInterval(pollTimer);
  document.getElementById('chatMain').innerHTML = '';
  document.getElementById('chatEmpty').style.display = 'flex';
  renderConversations();
}

async function loadMessages(id) {
  try {
    const res = await fetch(`${API_BASE}/conversations/${id}/messages?per_page=50`, { headers: { 'Authorization': `Bearer ${localStorage.getItem('token') || ''}`, 'Accept': 'application/json' } });
    const data = await res.json();
    if (data.success) {
      const msgs = data.messages.data || [];
      if (msgs.length > 0) lastMessageId = msgs[msgs.length - 1].id;
      renderMessages(msgs);
    }
  } catch (e) { console.error('Failed to load messages:', e); }
}

function renderMessages(msgs) {
  const container = document.getElementById('chatMessages');
  if (!container) return;
  container.innerHTML = msgs.map(m => {
    const isSent = m.sender_id === authUserId;
    const bubbleClass = isSent ? 'sent' : 'received';
    const senderName = m.sender ? m.sender.name : '';
    return `<div class="msg-row ${bubbleClass}">
      <div>
        ${!isSent ? `<div style="font-size:11px;color:#6b7280;margin-bottom:2px;margin-left:4px;">${senderName}</div>` : ''}
        <div class="msg-bubble">${m.message || ''}</div>
        <div class="msg-time">${m.created_at ? formatTime(m.created_at) : ''}</div>
      </div>
    </div>`;
  }).join('');
  container.scrollTop = 0;
}

async function pollMessages(id) {
  if (id !== activeConversationId) return;
  try {
    const res = await fetch(`${API_BASE}/messages?conversation_id=${id}&after_id=${lastMessageId}`, { headers: { 'Authorization': `Bearer ${localStorage.getItem('token') || ''}`, 'Accept': 'application/json' } });
    const data = await res.json();
    if (data.success && data.messages.length > 0) {
      const newMsgs = data.messages;
      lastMessageId = newMsgs[newMsgs.length - 1].id;
      const container = document.getElementById('chatMessages');
      if (container) {
        const html = newMsgs.map(m => {
          const isSent = m.sender_id === authUserId;
          const bubbleClass = isSent ? 'sent' : 'received';
          const senderName = m.sender ? m.sender.name : '';
          return `<div class="msg-row ${bubbleClass}">
            <div>
              ${!isSent ? `<div style="font-size:11px;color:#6b7280;margin-bottom:2px;margin-left:4px;">${senderName}</div>` : ''}
              <div class="msg-bubble">${m.message || ''}</div>
              <div class="msg-time">${m.created_at ? formatTime(m.created_at) : ''}</div>
            </div>
          </div>`;
        }).join('');
        container.insertAdjacentHTML('afterbegin', html);
      }
    }
  } catch (e) { console.error('Poll error:', e); }
}

async function sendMessage() {
  const input = document.getElementById('messageInput');
  const text = input.value.trim();
  if (!text || !activeConversationId) return;
  input.value = '';
  try {
    const res = await fetch(`${API_BASE}/send`, {
      method: 'POST',
      headers: { 'Authorization': `Bearer ${localStorage.getItem('token') || ''}`, 'Content-Type': 'application/json', 'Accept': 'application/json' },
      body: JSON.stringify({ conversation_id: activeConversationId, message: text, message_type: 'text' })
    });
    const data = await res.json();
    if (data.success) {
      if (data.message && data.message.id) {
        if (data.message.id > lastMessageId) lastMessageId = data.message.id;
      }
      pollMessages(activeConversationId);
    }
  } catch (e) { console.error('Send error:', e); }
}

function filterConversations() { renderConversations(); }

function startNewChat() {
  const search = prompt('Enter user name or email to search:');
  if (!search) return;
  fetch(`${API_BASE}/users/search?search=${encodeURIComponent(search)}`, { headers: { 'Authorization': `Bearer ${localStorage.getItem('token') || ''}`, 'Accept': 'application/json' } })
    .then(r => r.json()).then(data => {
      if (data.success && data.users.length > 0) {
        const u = data.users[0];
        fetch(`${API_BASE}/users/${u.id}/conversation`, { headers: { 'Authorization': `Bearer ${localStorage.getItem('token') || ''}`, 'Accept': 'application/json' } })
          .then(r => r.json()).then(d => {
            if (d.success) {
              const conv = d.conversation;
              const exists = conversations.find(c => c.id === conv.id);
              if (!exists) conversations.unshift(conv);
              openConversation(conv.id, conv.other_user?.name || conv.title || 'Chat');
            }
          });
      } else { alert('No users found.'); }
    });
}

loadConversations();
</script>
@endsection
