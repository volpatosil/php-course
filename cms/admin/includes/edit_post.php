<?php

if(isset($_GET['p_id'])) {

  $the_post_id = escape($_GET['p_id']);
}
  $query = "SELECT * FROM posts WHERE post_id = $the_post_id";
  $select_posts_by_id = mysqli_query($connection, $query);


  while($row = mysqli_fetch_assoc($select_posts_by_id)) {
    $post_id = escape($row['post_id']);
    $post_title = escape($row['post_title']);
    $post_user = escape($row['post_user']);
    $post_category_id = escape($row['post_category_id']);
    $post_status = escape($row['post_status']);
    $post_image = escape($row['post_image']);
    $post_content = escape($row['post_content']);
    $post_tags = escape($row['post_tags']);
    $post_comment_count = escape($row['post_comment_count']);
    $post_date = escape($row['post_date']);
    $post_views_count = escape($row['post_views_count']);
    

}

  if(isset($_POST['reset_views'])) {
    $query = "UPDATE posts SET post_views_count = '0' WHERE post_id = $the_post_id";
    $post_views_count_reset = mysqli_query($connection, $query);
    header("Location: posts.php?source=edit_post&p_id=$the_post_id");
  }

  if(isset($_POST['update_post'])) {
    $post_user = escape($_POST['post_user']);
    $post_title = escape($_POST['post_title']);
    $post_category_id = escape($_POST['post_category_id']);
    $post_status = escape($_POST['post_status']);
    $post_image = escape($_FILES['post_image']['name']);
    $post_image_temp = escape($_FILES['post_image']['tmp_name']);
    $post_content = escape($_POST['post_content']);
    $post_tags = escape($_POST['post_tags']);
    move_uploaded_file($post_image_temp, "../images/$post_image");

    if(empty($post_image)) {
      
      $query = "SELECT * FROM posts WHERE post_id = $the_post_id ";
      $select_image = mysqli_query($connection,$query);

      while($row = mysqli_fetch_array($select_image)) {
        $post_image = escape($row['post_image']);
      }

    }

    $query = "UPDATE posts SET ";
    $query .= "post_title = '{$post_title}', ";
    $query .= "post_category_id = '{$post_category_id}', ";
    $query .= "post_date = now(), ";
    $query .= "post_user = '{$post_user}', ";
    $query .= "post_status = '{$post_status}', ";
    $query .= "post_tags = '{$post_tags}', ";
    $query .= "post_content = '{$post_content}', ";
    $query .= "post_image = '{$post_image}' ";
    $query .= "WHERE post_id = {$the_post_id} "; 

    $update_post = mysqli_query($connection, $query);

    confirm($update_post);

    echo "<p class='bg-success'>Post Updated. <a href='../post.php?p_id={$the_post_id}'>View Post</a> or <a href='posts.php'>Edit More Posts</a></p>";


  }
?>

<form action="" method="post" enctype="multipart/form-data">

    <div class="form-group">
      <label for="post_title">Post Title</label>
      <input value="<?php  echo $post_title; ?>" type="text" class="form-control" name="post_title">
    </div>

    <div class="form-group">
      <label>View Count: <?php echo $post_views_count; ?></label><br>
      <input class="btn btn-xs btn-warning" type="submit" name="reset_views" value="Reset views">
    </div>

    <div class="form-group">
      <label for="post-category_id">Category: </label>
      <select name="post_category_id" id="">

        <?php
            $query = "SELECT * FROM categories";
            $select_categories = mysqli_query($connection, $query);

            confirm($select_categories);

            while($row = mysqli_fetch_assoc($select_categories)) {
              $cat_id = $row['cat_id'];
              $cat_title = $row['cat_title'];
          if ($cat_id != $post_category_id) {
              echo "<option value='{$cat_id}'>{$cat_title}</option>";
          } else if($cat_id == $post_category_id) {
              echo "<option selected value='{$cat_id}'>{$cat_title}</option>";
            }
        }
        ?>

      </select>
    </div>

  <div class="form-group">
    <label for="users">Post author </label>
      <select name="post_user" id="">
        <?php echo "<option value='{$post_user}'>{$post_user}</option>"; ?>

        <?php
        $query = "SELECT * FROM users";
        $select_users = mysqli_query($connection, $query);

        confirm($select_users);

        while ($row = mysqli_fetch_assoc($select_users)) {
          $user_id = $row['user_id'];
          $username = $row['username'];
          echo "<option value='{$username}'>{$username}</option>";
        }

        ?>

      </select>
    </div>
            
    <div class="form-group">
      <select name="post_status" id="">
        <option value='<?php echo $post_status ?>'><?php echo $post_status; ?></option>
        <?php
        if ($post_status == 'published') {
          echo "<option value='draft'>draft</option>";
        } else {
          echo "<option value='published'>published</option>";
        }
        ?>
      </select>
    </div>

    <div class="form-group">
    
      <img width="100" src="../images/<?php echo $post_image; ?>" alt="">
      <input type="file" name="post_image">
    </div>

    <div class="form-group">
      <label for="post_tags">Post Tags</label>
      <input  value="<?php  echo $post_tags ?>" type="text" class="form-control" name="post_tags">
    </div>

    <div class="form-group">
      <label for="post_content">Post Content</label>
      <textarea class="form-control" name="post_content" id="body" cols="30" rows="10"><?php echo $post_content ?></textarea>
    </div>



    <div class="form-group">
      <input class="btn btn-primary" type="submit" name="update_post" value="Update Post">
    </div>


  </form>