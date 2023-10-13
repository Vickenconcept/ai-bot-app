<button {{ $attributes->merge(['type' => 'button', 'class' => ' items-center  px-3  text-center  rounded bg-purple-600 hover:shadow-lg transition duration-300 py-2 text-xs font-semibold   disabled:opacity-25  ease-in-out']) }}>
    {{ $slot }}
</button>

