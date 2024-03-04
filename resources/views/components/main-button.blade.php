<button {{ $attributes->merge(['type' => 'button', 'class' => ' items-center  px-3  text-center  rounded bg-gradient-to-r from-violet-500 to-fuchsia-500 hover:bg-gradient-to-r hover:from-violet-600 hover:to-fuchsia-600 hover:shadow-lg transition duration-300 py-2 text-xs font-semibold   disabled:opacity-25  ease-in-out']) }}>
    {{ $slot }}
</button>

