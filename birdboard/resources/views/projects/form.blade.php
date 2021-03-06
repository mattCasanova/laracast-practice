<form 
    method="POST" 
    action="{{ $action }}"
    class="lg:w-1/2 lg:mx-auto bg-white p-6 md:py-12 md:px-16 rounded shadow"
>
    @csrf
    @method($method)

    <h1 class="heading text-2xl font-normal mb-10 text-center">
        {{ $title }}
    </h1>
        
    <div class="field mb-6">
        <label class="label text-sm mb-2 block" for="title">Title</label>

        <div class="control">
            <input 
                type="text" 
                class="input bg-transparent border border-grey-light rounded p-2 text-xs w-full" 
                name="title" 
                placeholder="My next awesome project"
                value="{{ $project->title }}"
                required        
            >
        </div>
    </div> 

    <div class="field mb-6">
        <label class="label text-sm mb-2 block" for="description">Description</label>

        <div class="control">
            <textarea 
                class="textarea bg-transparent border border-grey-light rounded p-2 text-xs w-full"  
                name="description"
                rows="10"
                placeholder="I should start learning piano"
                required
            >{{ $project->description }}</textarea>
        </div>
    </div> 

    <div class="field">
        <div class="control">
            <button type="submit" class="button is-link mr-2">{{ $buttonText }}</button>
            <a href="{{ $project->path() }}">Cancel</a>
        </div>
    </div>

    @if ($errors->any())
        <div class="field mt-6">
            @foreach ($errors->all() as $error)
                <li class="text-sm text-red">{{ $error }}</li>
            @endforeach
        </div>
    @endif
</form>

