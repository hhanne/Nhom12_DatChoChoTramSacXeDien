<!-- resources/views/profile/includes/topbar.blade.php -->
<form method="POST" action="{{ route('logout') }}" id="logout-form" style="display:none;">
    @csrf
</form>

<div class="top-bar">
    <div class="top-bar-left">
        <h2>Xin chào, {{ Auth::user()->hoten ?? Auth::user()->name }}!</h2>
        <p>Trạm Sạc EV</p>
    </div>
    <div class="top-bar-right">
        <a href="{{ route('dashboard') }}" class="logout-link" style="color:#00bfa6; font-weight:600;">
            <i class="fas fa-home"></i>
            <span>Dashboard</span>
        </a>
        <div class="notification-icon">
            <i class="fa-solid fa-bell"></i>
            <span class="notification-badge">3</span>
        </div>
        <div class="user-profile">
            <div class="user-avatar">{{ substr(Auth::user()->hoten ?? Auth::user()->name, 0, 1) }}</div>
            <div class="user-info">
                <p class="user-name">{{ Auth::user()->hoten ?? Auth::user()->name }}</p>
                <p class="user-email">{{ Auth::user()->email }}</p>
            </div>
        </div>
        <a href="#" onclick="confirmLogout(event)" class="logout-link">
            <i class="fa-solid fa-arrow-right-from-bracket"></i>
            <span>Đăng xuất</span>
        </a>
    </div>
</div>

<script>
function confirmLogout(event){
    event.preventDefault();
    if(confirm('Bạn có chắc chắn muốn đăng xuất không?')){
        document.getElementById('logout-form').submit();
    }
}
</script>
