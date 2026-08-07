@php $c = $course ?? null; @endphp

@if($errors->any())
    <div class="mb-6 p-4 bg-red-50 border border-red-200 rounded-xl text-sm text-red-700">
        <ul class="list-disc list-inside space-y-1">
            @foreach($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

    <div class="lg:col-span-2">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Titre du cours</label>
        <input type="text" name="title" value="{{ old('title', $c->title ?? '') }}" placeholder="Allemand B1 Intensive" required
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Langue</label>
        <input type="text" name="language" value="{{ old('language', $c->language ?? '') }}" placeholder="Allemand" required
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Niveau</label>
        <input type="text" name="level" value="{{ old('level', $c->level ?? '') }}" placeholder="B1 / IELTS" required
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div class="lg:col-span-2">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Description</label>
        <textarea name="description" rows="4"
                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">{{ old('description', $c->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Mode</label>
        <select name="mode" class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 text-sm outline-none transition">
            @foreach(['Présentiel', 'En ligne', 'Hybride'] as $mode)
                <option value="{{ $mode }}" {{ old('mode', $c->mode ?? 'Présentiel') == $mode ? 'selected' : '' }}>{{ $mode }}</option>
            @endforeach
        </select>
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Lieu</label>
        <input type="text" name="location" value="{{ old('location', $c->location ?? '') }}" placeholder="Centre de Douala (Akwa)" required
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Adresse précise</label>
        <input type="text" name="address" value="{{ old('address', $c->address ?? '') }}" placeholder="Immeuble ABC, 2ème étage"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Durée</label>
        <input type="text" name="duration" value="{{ old('duration', $c->duration ?? '') }}" placeholder="8 semaines"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Horaire</label>
        <input type="text" name="schedule" value="{{ old('schedule', $c->schedule ?? '') }}" placeholder="08h00 - 12h00"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
            Date de rentrée (texte affiché) <span class="text-slate-400 normal-case font-normal">ex: "15 Août"</span>
        </label>
        <input type="text" name="start_date" value="{{ old('start_date', $c->start_date ?? '') }}" placeholder="15 Août"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
            Date exacte <span class="text-slate-400 normal-case font-normal">(pour le tri/filtrage)</span>
        </label>
        <input type="date" name="session_date" value="{{ old('session_date', isset($c->session_date) ? $c->session_date->format('Y-m-d') : '') }}"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Places disponibles</label>
        <input type="number" name="capacity" value="{{ old('capacity', $c->capacity ?? '') }}" min="1" placeholder="15"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Tarif (FCFA)</label>
        <input type="number" name="price" value="{{ old('price', $c->price ?? '') }}" min="0" step="1" placeholder="85000"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Badge de statut</label>
        <input type="text" name="status_badge" value="{{ old('status_badge', $c->status_badge ?? '') }}" placeholder="Places limitées"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div class="lg:col-span-2">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">URL de l'image</label>
        <input type="url" name="image_url" value="{{ old('image_url', $c->image_url ?? '') }}" placeholder="https://..."
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div class="lg:col-span-2 flex items-center gap-3">
        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $c->is_published ?? true) ? 'checked' : '' }}
               class="w-4 h-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
        <label for="is_published" class="text-sm font-medium text-slate-700">Publier immédiatement (visible sur le site)</label>
    </div>

</div>
