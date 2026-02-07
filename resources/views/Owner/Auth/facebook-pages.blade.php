<h3>Select a Facebook Page</h3>

<form method="POST" action="{{ route('facebook.forms') }}">
    @csrf
    <input type="hidden" name="access_token" value="{{ $access_token }}">

    <select name="facebook_page_id" class="form-select">
        <option value="">Select a Facebook Page</option>
        @forelse($pages as $page)
            <option value="{{ $page['id'] }}">{{ $page['name'] }}</option>
        @empty
            <option value="">No pages available</option>
        @endforelse
    </select>

    <button type="submit" class="btn btn-primary">Get Forms</button>
</form>
