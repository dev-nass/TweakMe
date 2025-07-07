# Tweak Me
June 29, 2025:
-   This version of Tweak Me is primarily focused on learning testing.
-   Due to changes I made on XAMPP and Laragon, I can't access the phpmyadmin on the former, hence I moved to project here..

# Learned & Features
-   AJAX post liking and bookmarks
-   Google login
-   Polymorphic Relationships
-   Self referencing many-to-many relationship
-   Activity Status 0 (Offline) & 1 (Online) 

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

# Activity Status 0 (Offline) & 1 (Online)
-   Learned the difference between `setInterval` and `setTimeout`:
    - `setTimeout` only run one time,
    - `setInterval` runs multiple times on depending on the given time interval
- So everytime the user log-ins their status is changed to `true`, but in the JS file we are constantly running a `setTimeout` that triggers a function to set the user to online,
- That `setTimeout` is being reset everytime JS detect an event winthin the `window`, and `setTimeout` runs again its timer on the background
```
LoginController.php  app.js > web.php
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

(FOR DOUBLE CHECKING)
-   USER SEARCH FEATURE 
-   ALLOW THEM TO ADD USERS THERE
-   DOUBLE CHECK IF THE ADD, UNFRIEND, ACCEPT, DELETE are all working just fine

-   LEARN HOW TO SEND ALL INPUTS OF A FORM TO A PROMISE `HEADER{ ... }`
-   CREATE A FRONT END FOR EDIT PROFILE
-   ALLOW USERS TO UPLOAD THEIR PROFILE
-   ALLOW VIEO ATTACHMENTS AND ALSO MAKE THE ATTACHMENT TYPE DETECTION TO BE DYNAMIC WITHIN THE POSTCONTROLLER
-   RECHEK THE TEXTS THAT HAS TO BE DYNAMIC
-   LEARN HOW TO IMPLEMENT SERVICE CLASS TO SHORTEN THE CONTROLLER METHODS
    ...
-   CREATE THE FRONTEND FOR THE SETTINGS AND IMPLEMENT THE FOLLOWING:
    -   Email verification
    -   Forgot password
    -   SMS verifications
-   TAKE NOTE OF THE APPRROACH ABOUT MERGING COLLECTION FOR DETECTING TWO WAY FRIENDS.
-   AFTER THE PROJECT HAS BEEN FULLY SET-UP, LEARN HOW TO TDD


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
