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

# Notification Feature
- Polymorphic relationship allows me to create a very simple notification system
- Open the filkes to the following order to follow through the logic:
```
migrations/notification > models/Notifcation > (polymorphic rs) > models/Retweak, models/Like, models/Comments
```