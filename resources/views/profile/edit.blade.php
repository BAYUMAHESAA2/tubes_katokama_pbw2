<x-app-layout>
    <div class="row border border-secondary-subtle rounded-4 mx-5 my-4 shadow-sm">
        <div class="col-12 col-md-3 d-flex flex-column justify-content-center align-items-center py-4">
            <!-- Profile Image -->
                <div class="mb-4">
                    <img src="{{ asset('img/foto_profil.png') }}" alt="Profile" class="rounded-circle" style="width: 140px; height: 140px; object-fit: cover;">
                </div>

                <!-- Button -->
                <div>
                    <button type="button" class="btn btn-warning">Unggah foto</button>
                </div>
        </div>


        <div class="col">
            @include('profile.partials.update-profile-information-form')
        </div>
    </div>

    <div class="row border border-secondary-subtle rounded-4 mx-5 my-4 shadow-sm">
        @include('profile.partials.update-password-form')
    </div>

    <div class="row border border-secondary-subtle rounded-4 mx-5 my-4 shadow-sm">
        @include('profile.partials.delete-user-form')
    </div>

    <form method="POST" action="{{ route('logout') }}" class="mx-5 mb-4">
        @csrf
        <button type="submit" class="btn btn-outline-warning w-100">Keluar</button>
    </form>
</x-app-layout>
