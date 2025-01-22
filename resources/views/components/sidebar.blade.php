<nav id="sidebar" class="sidebar js-sidebar">
  <div class="sidebar-content js-simplebar">
    <a class="sidebar-brand" href="/">
      <span class="align-middle">Mine Inventory</span>
    </a>

    <ul class="sidebar-nav">
      <li class="sidebar-header">
        Analytics & Statistics
      </li>

      <x-sidebar-link :href="'/'" :active="request()->is('/')" :icon="'bar-chart-2'">Dashboard</x-sidebar-link>
      <x-sidebar-link :href="'/'" :active="request()->is('/category')" :icon="'file-text'">Report</x-sidebar-link>

      <li class="sidebar-header">
        Master Modules
      </li>

      <x-sidebar-link :href="route('category.index')" :active="request()->routeIs('category.*')" :icon="'tag'">Category</x-sidebar-link>
      <x-sidebar-link :href="route('supplier.index')" :active="request()->routeIs('supplier.*')" :icon="'truck'">Supplier</x-sidebar-link>
      <x-sidebar-link :href="route('storage-location.index')" :active="request()->routeIs('storage-location.*')" :icon="'archive'">Storage</x-sidebar-link>

      <li class="sidebar-header">
        Inventory
      </li>

      <x-sidebar-link :href="'/'" :active="request()->is('/category')" :icon="'box'">Item</x-sidebar-link>
      <x-sidebar-link :href="'/'" :active="request()->is('/category')" :icon="'download'">Item In</x-sidebar-link>
      <x-sidebar-link :href="'/'" :active="request()->is('/category')" :icon="'upload'">Item Out</x-sidebar-link>

      <li class="sidebar-header">
        User Management
      </li>

      <x-sidebar-link :href="'/'" :active="request()->is('/category')" :icon="'user'">Role</x-sidebar-link>
      <x-sidebar-link :href="'/'" :active="request()->is('/category')" :icon="'user-check'">Permission</x-sidebar-link>
      <x-sidebar-link :href="'/'" :active="request()->is('/category')" :icon="'users'">User</x-sidebar-link>
    </ul>
  </div>
</nav>