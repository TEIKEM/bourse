<x-guest-layout>

    <div class="mb-6 text-center">
        <img src="{{ asset('images/logo.jpg') }}" alt="KANTSA" class="h-14 mx-auto mb-3"
             onerror="this.style.display='none'">
        <h1 class="text-xl font-black text-[#0a1033]">Créer mon compte étudiant</h1>
        <p class="text-xs text-slate-500 mt-1">Renseigne tes informations pour candidater aux bourses et t'inscrire aux cours.</p>
    </div>

    <form method="POST" action="{{ route('register') }}" class="space-y-5">
        @csrf

        <div>
            <h3 class="text-xs font-bold text-red-600 uppercase tracking-wider mb-3">Compte</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div class="sm:col-span-2">
                    <input type="text" name="name" value="{{ old('name') }}" placeholder="Nom & Prénom" required autofocus
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                    @error('name') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div class="sm:col-span-2">
                    <input type="email" name="email" value="{{ old('email') }}" placeholder="Adresse Email" required
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                    @error('email') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <input type="password" name="password" placeholder="Mot de passe" required
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                    @error('password') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <input type="password" name="password_confirmation" placeholder="Confirmer le mot de passe" required
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                </div>
            </div>
        </div>

        <div>
            <h3 class="text-xs font-bold text-red-600 uppercase tracking-wider mb-3">Informations personnelles</h3>
            <div class="grid grid-cols-1 sm:grid-cols-2 gap-3">
                <div>
                    <input type="tel" name="phone" value="{{ old('phone') }}" placeholder="Téléphone / WhatsApp" required
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                    @error('phone') <p class="text-xs text-red-600 mt-1">{{ $message }}</p> @enderror
                </div>
                <div>
                    <input type="date" name="date_of_birth" value="{{ old('date_of_birth') }}" placeholder="Date de naissance"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                </div>
                <div>
                    <select name="gender" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm text-slate-600 outline-none transition">
                        <option value="">Genre (optionnel)</option>
                        <option value="homme" {{ old('gender') == 'homme' ? 'selected' : '' }}>Homme</option>
                        <option value="femme" {{ old('gender') == 'femme' ? 'selected' : '' }}>Femme</option>
                        <option value="autre" {{ old('gender') == 'autre' ? 'selected' : '' }}>Autre</option>
                    </select>
                </div>
                <div>
                    <input type="text" name="nationality" value="{{ old('nationality') }}" placeholder="Nationalité"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                </div>
                <div>
                    <input type="text" name="city" value="{{ old('city') }}" placeholder="Ville"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                </div>
                <div>
                    <select name="education_level" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm text-slate-600 outline-none transition">
                        <option value="">Niveau d'études</option>
                        <option value="bac" {{ old('education_level') == 'bac' ? 'selected' : '' }}>Baccalauréat</option>
                        <option value="licence" {{ old('education_level') == 'licence' ? 'selected' : '' }}>Licence</option>
                        <option value="master" {{ old('education_level') == 'master' ? 'selected' : '' }}>Master</option>
                    </select>
                </div>
                <div class="sm:col-span-2">
                    <input type="text" name="address" value="{{ old('address') }}" placeholder="Adresse (optionnel)"
                           class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
                </div>
            </div>
        </div>

        <button type="submit" class="w-full py-3.5 bg-red-600 hover:bg-red-500 text-white font-extrabold rounded-xl shadow-lg transition text-sm uppercase tracking-wider">
            Créer mon compte
        </button>

        <p class="text-center text-xs text-slate-500">
            Déjà un compte ? <a href="{{ route('login') }}" class="font-bold text-red-600 hover:underline">Se connecter</a>
        </p>
    </form>

</x-guest-layout>
