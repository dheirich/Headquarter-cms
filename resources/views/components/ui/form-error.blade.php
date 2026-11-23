@props(['field'])

@error($field)
<p {{$attributes->merge(['class' => 'text-red-200 bg-red-800 px-4 py-2 border border-white/10 w-full text-center mt-2'])}}>{{$message}}</p>
@enderror
