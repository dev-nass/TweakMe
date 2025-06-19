import "./bootstrap";

const base_url = document.querySelector('meta[name="base-url"]').content;
const userId = document.querySelector('meta[name="user-id"]').content;

setInterval(() => {
    fetch(`${base_url}/user/ping`, {
        method: "POST",
        headers: {
            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                .content,
            "Content-Type": "application/json",
        },
        body: JSON.stringify({}),
    }).catch((error) => {
        console.warn("Ping failed:", error);
    });
}, 10000); // every 10 seconds

window.addEventListener("onbeforeunload", (e) => {
    
    const blob = new Blob([JSON.stringify({ user_id: userId })], {
        type: "application/json",
    });

    navigator.sendBeacon(`${base_url}/user/close-tab`, blob);
});
