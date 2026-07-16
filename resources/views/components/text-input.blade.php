@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'border border-watt-border bg-watt-bg text-white focus:border-watt-cyan focus:ring-watt-cyan rounded-[16px] px-4 py-3 text-sm']) }}>
