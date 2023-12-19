<x-layout>
<div class="bg-gray-50 border border-gray-200 rounded p-10 max-w-lg mx-auto mt-24"
>
<header class="text-center">
    <h2 class="text-2xl font-bold uppercase mb-1">
        Create Profile
    </h2>
    <p class="mb-4">Create profile to find a punk date</p>
</header>

<form method="POST" action="/listings" enctype="multipart/form-data">

    @csrf
    <div class="mb-6">
        <label
            for="name"
            class="inline-block text-lg mb-2"
            >Name</label
        >
        <input
            type="text"
            class="border border-gray-200 rounded p-2 w-full"
            name="name"
           {{-- keep data in field after error --}}
          value="{{ old('name') }}" />
        {{-- if any of the form fields fail, laravel sends back an error message to the create view --}}
        @error('name')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
    </div>
    <div class="mb-6">
        <label for="age" class="inline-block text-lg mb-2">age</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="age"
          value="{{ old('age') }}" />

        @error('age')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="location" class="inline-block text-lg mb-2">Location</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="location"
          value="{{ old('location') }}" placeholder="Example: Boston MA, etc" />

        @error('location')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="email" class="inline-block text-lg mb-2">Email</label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="email"
          value="{{ old('email') }}" />

        @error('email')
          <p class="text-red-500 text-xs
          mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="tags" class="inline-block text-lg mb-2">
          Tags (Comma Separated)
        </label>
        <input type="text" class="border border-gray-200 rounded p-2 w-full" name="tags"
          value="{{ old('tags') }}" placeholder="Example: female, male, straight, gay, bi" />

        @error('tags')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="logo" class="inline-block text-lg mb-2">
          Profile Picture
        </label>
        <input type="file" class="border border-gray-200 rounded p-2 w-full" name="logo" />

        @error('logo')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <label for="description" class="inline-block text-lg mb-2">
          Description
        </label>
        <textarea class="border border-gray-200 rounded p-2 w-full" name="description" rows="10"
          placeholder="Include: age, bio, bla, etc...">
      {{ old('description') }}
        </textarea>

        @error('description')
          <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
        @enderror
      </div>

      <div class="mb-6">
        <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
          Create Profile
        </button>

        <a href="/" class="text-black ml-4"> Back </a>
      </div>
    </form>
  </div>
</x-layout>