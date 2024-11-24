<form method="POST" action="{{ route('user.updateProfile') }}">
    @csrf
    <div>
        <label for="phone">Phone</label>
        <input type="text" id="phone" name="phone" value="{{ auth()->user()->phone }}">
    </div>
    <div>
        <label for="address">Address</label>
        <textarea id="address" name="address">{{ auth()->user()->address }}</textarea>
    </div>
    <button type="submit">Update</button>
</form>
