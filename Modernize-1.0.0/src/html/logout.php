<?php
/*function logout() {

                                            fetch('logout.php', {
                                                method: 'POST',
                                                headers: {
                                                    'Content-Type': 'application/json',
                                                },
                                            }).then(response => {
                                                if (response.ok) {
                                                    window.location.href = 'login.php';
                                                }
                                            });
                                        }*/
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    session_start();
    session_destroy();
    echo json_encode(["status" => true]);
}

?>