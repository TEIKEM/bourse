@php $s = $service ?? null; @endphp

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

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Titre du service</label>
        <input type="text" name="title" value="{{ old('title', $s->title ?? '') }}" required
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
        @if($s)
            <p class="text-xs text-slate-400 mt-1">Slug actuel : /{{ $s->slug }}</p>
        @else
            <p class="text-xs text-slate-400 mt-1">Le lien (slug) sera généré automatiquement à partir du titre.</p>
        @endif
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Icône (emoji)</label>
        <input type="text" name="icon" value="{{ old('icon', $s->icon ?? '') }}" placeholder="🎓"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div class="lg:col-span-2">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Résumé (affiché sur les cartes)</label>
        <input type="text" name="short_description" value="{{ old('short_description', $s->short_description ?? '') }}" maxlength="255"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div class="lg:col-span-2">
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Description complète (page détail)</label>
        <textarea name="description" rows="5"
                  class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">{{ old('description', $s->description ?? '') }}</textarea>
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Texte du bouton d'action</label>
        <input type="text" name="cta_label" value="{{ old('cta_label', $s->cta_label ?? '') }}" placeholder="Découvrir les Bourses"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Lien du bouton d'action</label>
        <input type="text" name="cta_link" value="{{ old('cta_link', $s->cta_link ?? '') }}" placeholder="/bourses"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">URL de l'image</label>
        <input type="url" name="image_url" value="{{ old('image_url', $s->image_url ?? '') }}" placeholder="https://..."
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div>
        <label class="block text-xs font-bold text-slate-700 uppercase tracking-wider mb-2">Ordre d'affichage</label>
        <input type="number" name="order" value="{{ old('order', $s->order ?? 0) }}" min="0"
               class="w-full px-4 py-3 rounded-xl bg-gray-50 border border-gray-200 focus:border-red-500 focus:ring-1 focus:ring-red-500 text-sm outline-none transition">
    </div>

    <div class="lg:col-span-2 flex items-center gap-3">
        <input type="checkbox" name="is_published" id="is_published" value="1" {{ old('is_published', $s->is_published ?? true) ? 'checked' : '' }}
               class="w-4 h-4 rounded border-gray-300 text-red-600 focus:ring-red-500">
        <label for="is_published" class="text-sm font-medium text-slate-700">Publier immédiatement (visible sur le site)</label>
    </div>

</div>
