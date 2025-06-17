# Tweak Me

# Liking Feature

-   Made use of AJAX and JS promises, <br>
-   This is what the header of the code looks like:

```js
fetch(url, {
    method: method,
    headers: {
        "X-CSRF-TOKEN": "{{ csrf_token() }}",
        Accept: "application/json",
        "Content-Type": "application/json",
    },
}).then((response) => response.json());
```

# Notification Feature

-   Polymorphic relationship allows me to create a very simple notification system
-   Open the filkes to the following order to follow through the logic:

```
migrations/notification > models/Notifcation > (polymorphic rs) > models/Retweak, models/Like, models/Comments
```

# Google Login

-   Make use of Google Cloud Console and setup and new project,
-   A new credentials under Api & Services.
-   Pasted the data from Google Cloud Console after setting everything up to `.env` file and also added `google` configurations within `services.php`:

```
.env > services.php > web.php > login.blade.php > SocialiteController.php
```

### Tasks
-   CONSIDER CHANGING THE ERD ARCHITECTURE AND COMBINE POST AND RETWEAKS WITHIN THE SAME TABLE, THIS ALLOWS BOTH TO HAVE LIKES AND COMMENT CHATGGPT ALREADY HAS SUGGGESTIONS INTEGRATE THAT.
-   FINISH THE PROFILE PAGE
-   AFTER THAT CREATE THE PAGE FOR THE FRIEND REQUESTS INDEX
-   FRIENDS PAGES
-   ADD A WAY FOR POSTS AND RETWEAK TO BE PUBLIC AND FRIENDS (DOUBLE CECK THIS)
-   WHAT IF WE CREATE A POST CONTAINER COMPONENT THAT WILL CONTAIN ALL CODE FOR DISPLAYING A SINGLE POST
-   ADD AN ICON FOR VISUALIZING THE POSTS SELECTED AUDIENCE
-   ISSUE: THE `ADD FRIEND REQUEST` table is allowing once end relationship, meaning the receiver of the requestis only one having a new friend if they accepted that, the sender won't be having a new friend record even if the request is accepted by the receiver.
    -   MERGED TWO METHOD THAT FETCHES ONE DIRECTIONAL FRIEND DIRECTION

-   USER SEARCH FEATURE 
-   ALLOW THEM TO ADD USERS THERE
-   DOUBLE CHECK IF THE ADD, UNFRIEND, ACCEPT, DELETE are all working just fine

-   ALLOW USERS TO UPLOAD THEIR PROFILE
-   ALLOW VIEO ATTACHMENTS AND ALSO MAKE THE ATTACHMENT TYPE DETECTION TO BE DYNAMIC WITHIN THE POSTCONTROLLER
-   RECHEK THE TEXTS THAT HAS TO BE DYNAMIC
-   LEARN HOW TO IMPLEMENT SERVICE CLASS TO SHORTEN THE CONTROLLER METHODS
    ...
-   AFTER THE PROJECT HAS BEEN FULLY SET-UP, LEARN HOW TO TDD
-   LEARN HOW TO SEND ALL INPUTS OF A FORM TO A PROMISE `HEADER{ ... }`

# Refactors

### Posts and Retweaks on same table

-   Altered the controller to fit these changes
-   Added additional relationship on Post Model

```php
/**
* Return a single retweak, used within
* index.blade.php for retrieving a post
* record's retweak, if (is_retweak == 1)
*/
public function retweak()
{
    return $this->belongsTo(Post::class, 'parent_id');
}

/**
* Returns a post retweaks, not used
* yet
*/
public function retweaks()
{
    return $this->hasMany(Post::class, 'parent_id');
}
```
