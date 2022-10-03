<?php
  
  function getAllTweets() {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM tweets JOIN 
                                 users USING(username) 
                            ORDER BY time DESC");
    $stmt->execute();
    return $stmt->fetchAll();
  }
  
  function getUserTweets($titanium_username) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM tweets JOIN 
                                 users USING(username) 
                            WHERE username = ? 
                            ORDER BY time DESC");
    $stmt->execute(array($titanium_username));
    return $stmt->fetchAll();
  }

  function createTweet($titanium_username, $tweet) {
    global $conn;
    $stmt = $conn->prepare("INSERT INTO tweets 
                            VALUES (DEFAULT, ?, ?, ?)");
    $stmt->execute(array(date('Y-m-d H:i:s'), $titanium_username, $tweet));
  }
  
  function getTweetCountAfter($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT COUNT(*) AS count
                            FROM tweets 
                            WHERE id > ?");
    $stmt->execute(array($id));
    $result = $stmt->fetch();    
    return $result['count'];
  }

  function getTweetsAfter($id) {
    global $conn;
    $stmt = $conn->prepare("SELECT * 
                            FROM tweets JOIN 
                                 users USING(username) 
                            WHERE id > ?
                            ORDER BY time");
    $stmt->execute(array($id));
    return $stmt->fetchAll();
  }

?>
