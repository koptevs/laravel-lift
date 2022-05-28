<a {{ $attributes->merge([ 'href' => '#', 'class' => 'inline-block px-6 py-2.5 bg-slate-700 text-white font-medium tracking-widest text-xs leading-tight uppercase rounded shadow-md hover:bg-slate-500 hover:shadow-lg focus:bg-slate-500 focus:shadow-lg focus:outline-none focus:ring-0 active:bg-slate-600 active:shadow-lg transition duration-150 ease-in-out']) }}>
    {{ $slot }}
</a>
