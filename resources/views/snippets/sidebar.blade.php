<div class="card">
  <ul class="collection">
    <li class="collection-item avatar">
      <a href="#" data-activates="slide-out" data-position="right" data-delay="50"  data-tooltip="Menu">
        <i title="Menu" class="material-icons circle grey button-collapse tooltipped">menu</i></a>
    </li>
    <li class="collection-item avatar">
      <a href="/shared"  data-position="right"  data-delay="50" data-tooltip="Shared Files">
        <i class="material-icons circle purple lighten-1 tooltipped" title="Shared Files">share</i></a>
    </li>
    <li class="collection-item avatar">
      <a href="/documents" data-position="right" data-delay="50" data-tooltip="Documents">
        <i class="material-icons circle blue darken-1 tooltipped" title="Documents">folder</i></a>
    </li>
    <li class="collection-item avatar">
      <a href="/categories"  data-position="right" data-delay="50" data-tooltip="Categories">
        <i class="material-icons circle brown tooltipped" title="Categories">class</i></a>
    </li>
   {{--  @hasanyrole('Root|Admin') --}}
    <li class="collection-item avatar">
      <a href="{{url('/users')}}"  data-position="right" data-delay="50" data-tooltip="Users">
        <i class="material-icons circle green tooltipped" title="Users">person</i></a>
    </li>
    {{-- Glen 653251366 --}}
    {{-- @hasrole('Root') --}}
    <li class="collection-item avatar">
        <a href="{{ url('/faculties') }}" data-position="right" data-delay="50" data-tooltip="Faculties">
          <i class="material-icons circle grey darken-1 tooltipped"  title="Faculties">house</i></a>
      </li>
    <li class="collection-item avatar">
      <a href="/departments" data-position="right" data-delay="50" data-tooltip="Departments">
        <i class="material-icons circle red darken-1 tooltipped" title="Departments">group</i></a>
    </li>
    <li class="collection-item avatar">
      <a href="/roles"  data-position="right"  data-delay="50" data-tooltip="Roles &amp; Permissions">
        <i class="material-icons circle cyan darken-1 tooltipped" title="Roles &amp; Permissions">assignment_ind</i></a>
    </li>
    <li class="collection-item avatar">
      <a href="/backup"  data-position="right" data-delay="50" data-tooltip="Backup Manager">
        <i class="material-icons circle indigo assent-1 tooltipped" title="Backup Manager">backup</i></a>
    </li>
    <li class="collection-item avatar">
      <a href="/logs"  data-position="right" data-delay="50" data-tooltip="Logs">
        <i class="material-icons circle orange tooltipped" title="Logs">view_list</i></a>
    </li>
    {{-- @endhasrole --}}
    {{-- @endhasanyrole --}}
    {{-- @hasanyrole('Admin|User') --}}
    <li class="collection-item avatar">
      <a href="/mydocuments" data-position="right" data-delay="50" data-tooltip="My Documents">
        <i class="material-icons circle pink darken-1 tooltipped" title="My Documents">folder_shared</i></a>
    </li>
    {{-- @endhasanyrole --}}
  </ul>
</div>
<!-- ======================================================================= -->
<ul id="slide-out" class="side-nav">
  <li><div class="user-view">
    <div class="background">
      <img src="/storage/images/ytu.jpg" width="100%">
    </div>
  </div></li>
  <li><a href="{{ url('/shared') }}"><i class="material-icons">share</i>Share</a></li>
  <li><a href="/documents"><i class="material-icons">folder</i>Documents</a></li>
  <li><a href="/categories"><i class="material-icons">class</i>Categories</a></li>
 {{-- @hasanyrole('Root|Admin') --}}
  <li><a href="/users"><i class="material-icons">person</i>Users</a></li>
  {{-- @hasrole('Root') --}}
  <li><a href="/departments"><i class="material-icons">group</i>Departments</a></li>
  <li><div class="divider"></div></li>
  <li><a href="/roles"><i class="material-icons">assignment_ind</i>Roles &amp; Permissions</a></li>
  <li><a href="/backup"><i class="material-icons">backup</i>Backup Manager</a></li>
  <li><a href="/logs"><i class="material-icons">view_list</i>Logs</a></li>
  {{-- @endhasrole --}}
  {{-- @endhasanyrole --}}
  {{-- @hasanyrole('Admin|User') --}}
  <li>
    <a href="/mydocuments"><i class="material-icons">folder_shared</i>My Documents</a>
  </li>
  {{-- @endhasanyrole --}}
</ul>
