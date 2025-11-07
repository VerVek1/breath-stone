<nav style="background:#111; border-bottom:1px solid #2a2a2a;">
  <div class="container" style="display:flex; gap:12px; align-items:center; padding:10px 0;">
    <a href="{{ route('admin.index') }}" style="color:#fff; text-decoration:none; font-weight:600; margin-right:16px;">Админ</a>
    <a href="{{ route('admin.materials.index') }}" style="color:{{ request()->routeIs('admin.materials.*') ? '#fff' : '#bbb' }}; text-decoration:none;">Материалы</a>
    <a href="{{ route('admin.manufacturers.index') }}" style="color:{{ request()->routeIs('admin.manufacturers.*') ? '#fff' : '#bbb' }}; text-decoration:none;">Производители</a>
    <a href="{{ route('admin.stones.index') }}" style="color:{{ request()->routeIs('admin.stones.*') ? '#fff' : '#bbb' }}; text-decoration:none;">Камни</a>
    <a href="{{ route('admin.applications.index') }}" style="color:{{ request()->routeIs('admin.applications.*') ? '#fff' : '#bbb' }}; text-decoration:none;">Заявки</a>
  </div>
</nav>