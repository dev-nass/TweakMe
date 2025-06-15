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


# Google Login
- Make use of Google Cloud Console and setup and new project,
- A new credentials under Api & Services.
- Pasted the data from Google Cloud Console after setting everything up to `.env` file and also added `google` configurations within `services.php`:
```
.env > services.php > web.php > login.blade.php > SocialiteController.php
```


### Tasks
- CONSIDER CHANGING THE ERD ARCHITECTURE AND COMBINE POST AND RETWEAKS WITHIN THE SAME TABLE, THIS ALLOWS BOTH TO HAVE LIKES AND COMMENT CHATGGPT ALREADY HAS SUGGGESTIONS INTEGRATE THAT.
- FINISH THE PROFILE PAGE
- AFTER THAT CREATE THE PAGE FOR THE FRIEND REQUESTS INDEX
- LEARN HOW TO IMPLEMENT SERVICE CLASS TO SHORTEN THE CONTROLLER METHODS
...
- AFTER THE PROJECT HAS BEEN FULLY SET-UP, LEARN HOW TO TDD