@if(Auth::user()->role === 'corporate')
    <li><a href="{{ route('corporate.dashboard') }}" class="{{ request()->routeIs('corporate.dashboard') ? 'active' : '' }}"><i class="fas fa-th-large"></i> <span>Overview</span></a></li>
    <li><a href="{{ route('corporate.fleet') }}" class="{{ request()->routeIs('corporate.fleet') ? 'active' : '' }}"><i class="fas fa-car"></i> <span>My Fleet</span></a></li>
    <li><a href="{{ route('corporate.billing') }}" class="{{ request()->routeIs('corporate.billing') ? 'active' : '' }}"><i class="fas fa-file-invoice-dollar"></i> <span>Billing</span></a></li>
    <li><a href="{{ route('corporate.new-request') }}" class="{{ request()->routeIs('corporate.new-request') ? 'active' : '' }}"><i class="fas fa-plus-circle"></i> <span>New Request</span></a></li>
    <li><a href="{{ route('corporate.history') }}" class="{{ request()->routeIs('corporate.history') ? 'active' : '' }}"><i class="fas fa-history"></i> <span>History</span></a></li>
    <li><a href="{{ route('contact') }}"><i class="fas fa-headset"></i> <span>Support</span></a></li>
    <li><a href="{{ route('corporate.settings') }}" class="{{ request()->routeIs('corporate.settings') ? 'active' : '' }}"><i class="fas fa-cog"></i> <span>Settings</span></a></li>
@elseif(Auth::user()->role === 'owner' || Auth::user()->role === 'driver')
    <li><a href="{{ route('owner.dashboard') }}" class="{{ request()->routeIs('owner.dashboard') ? 'active' : '' }}"><i class="fas fa-chart-line"></i> <span>My Stats</span></a></li>
    <li><a href="{{ route('owner.cars') }}" class="{{ request()->routeIs('owner.cars') ? 'active' : '' }}"><i class="fas fa-car-side"></i> <span>My Cars</span></a></li>
    <li><a href="{{ route('owner.history') }}" class="{{ request()->routeIs('owner.history') ? 'active' : '' }}"><i class="fas fa-route"></i> <span>Trip History</span></a></li>
    <li><a href="{{ route('owner.earnings') }}" class="{{ request()->routeIs('owner.earnings') ? 'active' : '' }}"><i class="fas fa-wallet"></i> <span>Earnings</span></a></li>
    <li><a href="{{ route('owner.profile') }}" class="{{ request()->routeIs('owner.profile') ? 'active' : '' }}"><i class="fas fa-user-edit"></i> <span>Profile</span></a></li>
    <li><a href="{{ route('owner.documents') }}" class="{{ request()->routeIs('owner.documents') ? 'active' : '' }}"><i class="fas fa-file-alt"></i> <span>Documents</span></a></li>
    <li><a href="{{ route('contact') }}"><i class="fas fa-question-circle"></i> <span>Help Center</span></a></li>
@elseif(Auth::user()->role === 'solo')
    <li><a href="{{ route('dashboard.index') }}" class="{{ request()->routeIs('dashboard.index') ? 'active' : '' }}"><i class="fas fa-th-large"></i> <span>Overview</span></a></li>
    <li><a href="{{ route('user.trips') }}" class="{{ request()->routeIs('user.trips') ? 'active' : '' }}"><i class="fas fa-history"></i> <span>My Trips</span></a></li>
    <li><a href="{{ route('user.saved-places') }}" class="{{ request()->routeIs('user.saved-places') ? 'active' : '' }}"><i class="fas fa-heart"></i> <span>Saved Places</span></a></li>
    <li><a href="{{ route('owner.profile') }}"><i class="fas fa-user-cog"></i> <span>My Profile</span></a></li>
    <li><a href="{{ route('contact') }}"><i class="fas fa-headset"></i> <span>Support</span></a></li>
@endif
