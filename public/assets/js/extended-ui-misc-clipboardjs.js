"use strict";!function(){const t=[].slice.call(document.querySelectorAll(".clipboard-btn"));ClipboardJS?t.map(function(t){const c=new ClipboardJS(t);c.on("success",function(t){"copy"==t.action&&toastr.success("","Copied to Clipboard!!")})}):t.map(function(t){t.setAttribute("disabled",!0)})}();