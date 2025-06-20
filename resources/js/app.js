import "./bootstrap";

const base_url = document.querySelector('meta[name="base-url"]').content;
const userId = document.querySelector('meta[name="user-id"]').content;
const csrfToken = document.querySelector('meta[name="csrf-token"]').content;

let isOnline = false;
let inactivityInterval = null;
const INACTIVITY_LIMIT = 10000;

const setOnline = () => {
    isOnline = true;
    console.log("active");
    fetch(`${base_url}/user/ping`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": csrfToken,
            "Content-Type": "application/json",
        },
        body: JSON.stringify({}),
    }).catch((error) => {
        console.warn("Ping failed:", error);
    });
};

const setOffline = () => {
    console.log("inactive");
    isOnline = false;
    const blob = new Blob(
        [
            JSON.stringify({
                user_id: userId,
                _token: csrfToken, // Laravel looks for _token by default
            }),
        ],
        {
            type: "application/json",
        }
    );

    navigator.sendBeacon(`${base_url}/user/inactive`, blob);
};

const resetOnlineInterval = () => {
    setOnline();
    clearTimeout(inactivityInterval);
    //  function, delay
    //  inactivityInterval holds a timeout ID (number)
    //  It’s used to cancel or replace a pending setTimeout
    //  It does not contain the return value of setOffline(), just a reference to the scheduled timer
    inactivityInterval = setTimeout(setOffline, INACTIVITY_LIMIT);
};

// window.addEventListener("mousemove", resetOnlineInterval);
// window.addEventListener("mousedown", resetOnlineInterval);
// window.addEventListener("keydown", resetOnlineInterval);
// window.addEventListener("scroll", resetOnlineInterval);
// window.addEventListener("touchstart", resetOnlineInterval);

// setInterval(() => {
//     setOffline();
// }, 10000);

document.addEventListener("visibilitychange", () => {
    if (document.visibilityState === "hidden") {
        setOffline();
    }
});

["mousemove", "mousedown", "keydown", "scroll", "touchstart"].forEach(
    (event) => {
        window.addEventListener(event, resetOnlineInterval);
    }
);
