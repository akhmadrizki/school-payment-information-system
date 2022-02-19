/**
 *
 * You can write your JS code here, DO NOT touch the default style file
 * because it will make it harder for you to update.
 *
 */

"use strict";

const logout = document.getElementById("logout");
logout.addEventListener("click", function (e) {
    e.preventDefault();
    document.getElementById("logout-form").submit();
});
