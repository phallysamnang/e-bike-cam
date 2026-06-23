@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'bg-white/5 border border-white/10 text-white focus:border-brand focus:ring-brand rounded-xl shadow-sm px-4 py-3 w-full']) }}>
