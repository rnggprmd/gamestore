<button {{ $attributes->merge(['type' => 'submit', 'class' => 'inline-flex items-center px-4 py-2 bg-watt-cyan text-watt-bg border border-transparent rounded-[16px] font-bold text-xs uppercase tracking-widest hover:brightness-110 focus:outline-none focus:ring-2 focus:ring-watt-cyan focus:ring-offset-2 transition ease-in-out duration-150 cursor-pointer']) }}>
    {{ $slot }}
</button>
