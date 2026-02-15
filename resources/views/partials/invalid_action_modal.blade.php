{{-- This is a Blade partial, intended to be included in other views --}}
<div id="invalidActionModal" class="modal-overlay" style="display: none;">
    <div class="modal-content">
        <h2>Invalid Action</h2>
        <p>Before performing any action on this website, please sign up first or if you already have an account, please log in.</p>
        <div class="modal-buttons">
            <a href="{{ route('register') }}" class="btn btn-signup">Sign up</a> {{-- Links to Laravel register route --}}
            <a href="{{ route('login') }}" class="btn btn-login">Log in</a> {{-- Links to Laravel login route --}}
        </div>
        <button class="close-modal-btn">&times;</button>
    </div>
</div>
