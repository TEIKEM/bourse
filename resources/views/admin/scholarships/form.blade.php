@php $s = $scholarship ?? null; @endphp

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
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Titre de la bourse</label>
        <input type="text" name="title" value="{{ old('title', $s->title ?? '') }}" required
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div class="lg:col-span-2">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Description</label>
        <textarea name="description" rows="5" required
                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">{{ old('description', $s->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Université</label>
        <input type="text" name="university" value="{{ old('university', $s->university ?? '') }}" required
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Pays</label>
        <input type="text" name="country" value="{{ old('country', $s->country ?? '') }}" required
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Drapeau (emoji)</label>
        <input type="text" name="flag" value="{{ old('flag', $s->flag ?? '') }}" placeholder="🇩🇪"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Type</label>
        <input type="text" name="type" value="{{ old('type', $s->type ?? '') }}" placeholder="Bourse Complète" required
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Badge de statut</label>
        <input type="text" name="status_badge" value="{{ old('status_badge', $s->status_badge ?? '') }}" placeholder="Places limitées"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Niveau requis</label>
        <input type="text" name="level" value="{{ old('level', $s->level ?? '') }}" placeholder="Master / Doctorat" required
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Prise en charge</label>
        <input type="text" name="coverage" value="{{ old('coverage', $s->coverage ?? '') }}" placeholder="Scolarité + Logement"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Date limite</label>
        <input type="date" name="deadline" value="{{ old('deadline', isset($s->deadline) ? $s->deadline->format('Y-m-d') : '') }}"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">
            Nombre de places <span class="text-slate-400 normal-case font-normal">(laisser vide = illimité)</span>
        </label>
        <input type="number" name="capacity" value="{{ old('capacity', $s->capacity ?? '') }}" min="0" placeholder="Ex: 10"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div class="lg:col-span-2">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">URL de l'image</label>
        <input type="url" name="image_url" value="{{ old('image_url', $s->image_url ?? '') }}" placeholder="https://..."
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div class="lg:col-span-2 flex items-center gap-3">
        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $s->is_published ?? true) ? 'checked' : '' }}
               class="w-4 h-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
        <label for="is_published" class="text-sm font-medium text-slate-700">Publier immédiatement (visible sur le site)</label>
    </div>

</div>
