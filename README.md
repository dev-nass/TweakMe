# Tweak Me


# Liking Feature
- Made use of AJAX and JS promises, <br>
- This is what the header of the code looks like:
```js
fetch(url, {
    method: method,
    headers: {
        'X-CSRF-TOKEN': '{{ csrf_token() }}',
        'Accept': 'application/json',
        'Content-Type': 'application/json',
    },
})
.then(response => response.json())
```