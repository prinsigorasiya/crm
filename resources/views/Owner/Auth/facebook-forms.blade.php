<h3>Select a Facebook Form</h3>

<form method="POST" action="{{ route('facebook.leads') }}">
    @csrf
    <input type="hidden" name="access_token" value="{{ $access_token }}">
    <input type="hidden" name="facebook_page_id" value="{{ $facebook_page_id }}">

    <select name="facebook_form_id" class="form-select">
        <option value="">Select a Facebook Form</option>
        @forelse($forms as $form)
            <option value="{{ $form['id'] }}">{{ $form['name'] }}</option>
        @empty
            <option value="">No forms available</option>
        @endforelse
    </select>

    <button type="submit" class="btn btn-success">Get Leads</button>
</form>
