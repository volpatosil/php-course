<?php

include("delete_modal.php");

if(isset($_POST['checkBoxArray'])) {
  foreach($_POST['checkBoxArray'] as $postValueId){
    $bulk_options = $_POST['bulk_options'];

    switch($bulk_options) {
      case 'published':
      
      $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";

      $update_to_published_status = mysqli_query($connection, $query);
      confirm($update_to_published_status);
      break;

      case 'draft':
      
      $query = "UPDATE posts SET post_status = '{$bulk_options}' WHERE post_id = {$postValueId} ";

      $update_to_draft_status = mysqli_query($connection, $query);
      confirm($update_to_draft_status);
      break;

      case 'delete':

      $query = "DELETE FROM posts WHERE post_id = {$postValueId} ";

      $update_to_delete_status = mysqli_query($connection, $query);
      confirm($update_to_delete_status);
      break;

      case 'clone':

      $query = "SELECT * FROM posts WHERE post_id = {$postValueId} ";

      $select_post_query = mysqli_query($connection, $query);
      
      while ($row = mysqli_fetch_array($select_post_query)) {
        $post_title       = escape($row['post_title']);
        $post_category_id = escape($row['post_category_id']);
        $post_date        = escape($row['post_date']);
        $post_author      = escape($row['post_author']);
        $post_user        = escape($row['post_user']);
        $post_status      = escape($row['post_status']);
        $post_image       = escape($row['post_image']);
        $post_tags        = escape($row['post_tags']);
        $post_content     = escape($row['post_content']);

      }

      $query  = "INSERT INTO posts(post_category_id, post_title, post_date, post_author, post_user, post_status, post_image, post_tags, post_content) ";
      $query .= "VALUES({$post_category_id}, '{$post_title}', '{$post_date}', '{$post_author}', '{$post_user}', '{$post_status}', '{$post_image}', '{$post_tags}', '{$post_content}')";
      $copy_query = mysqli_query($connection, $query);

      if(!$copy_query) {
        die("QUERY FAILED" .  mysqli_error($connection));
      }
      break;


    }


  }
}

?>


<form action="" method="post">


  <table class="table table-bordered table-hover">

    <div id="bulkOptionsContainer" class="col-xs-4">

      <select class="form-control" name="bulk_options" id="">
        <option value="">Select Options</option>
        <option value="published">Publish</option>
        <option value="draft">Draft</option>
        <option value="delete">Delete</option>
        <option value="clone">Clone</option>
      </select>

    </div>

    <div class="col-xs-4">
      <input type="submit" name="submit" class="btn btn-success" value="Apply">
      <a href="posts.php?source=add_post" class="btn btn-primary">Add New</a>
    </div>

    <thead>
      <tr>
        <th><input id="selectAllBoxes" type="checkbox"></th>
        <th>Id</th>
        <th>Users</th>
        <th>Title</th>
        <th>Category</th>
        <th>Status</th>
        <th>Image</th>
        <th>Tags</th>
        <th>Comments</th>
        <th>Date</th>
        <th>View Post</th>
        <th>Edit</th>
        <th>Delete</th>
      </tr>
    </thead>
    <tbody>

      <?php
      /* $query = "SELECT * FROM posts ORDER BY post_id DESC "; */
      $query  = "SELECT posts.post_id, posts.post_author, posts.post_user, posts.post_title, posts.post_category_id, posts.post_status, posts.post_image, ";
      $query .= "posts.post_tags, posts.post_comment_count, posts.post_date, posts.post_views_count, categories.cat_id, categories.cat_title ";
      $query .= " FROM posts ";
      $query .= " LEFT JOIN categories ON posts.post_category_id = categories.cat_id ORDER BY posts.post_id DESC";


      $select_posts = mysqli_query($connection, $query);

      while($row = mysqli_fetch_assoc($select_posts)) {
        $post_id            = escape($row['post_id']);
        $post_title         = escape($row['post_title']);
        $post_author        = escape($row['post_author']);
        $post_user          = escape($row['post_user']);
        $post_category_id   = escape($row['post_category_id']);
        $post_status        = escape($row['post_status']);
        $post_image         = escape($row['post_image']);
        $post_tags          = escape($row['post_tags']);
        $post_comment_count = escape($row['post_comment_count']);
        $post_date          = escape($row['post_date']);
        $post_views_count   = escape($row['post_views_count']);
        $category_title     = escape($row['cat_title']);
        $post_category_id   = escape($row['cat_id']);
        echo "<tr>";
        ?>
        <td><input class='checkBoxes' type='checkbox' name='checkBoxArray[]' value='<?php echo $post_id ?>'></td>
        <?php
        echo "<td>{$post_id}</td>";


        if (!empty($post_user)) {
        echo "<td>{$post_user}</td>";
        } elseif(!empty($post_author)) {
        echo "<td>{$post_author}</td>";
        } else {
          echo "<td>No user assigned.</td>";
        }


        echo "<td>{$post_title}</td>";

        /* $query = "SELECT * FROM categories WHERE cat_id = {$post_category_id} ";
        $select_categories_id = mysqli_query($connection,$query);   */

/*         while($row = mysqli_fetch_assoc($select_categories_id)) {
        $cat_id = escape($row['cat_id']);
        $cat_title = escape($row['cat_title']); */

                  
        echo "<td>{$category_title}</td>";
                      
        /* } */

        echo "<td>{$post_status}</td>";
        echo "<td><img class='img-responsive' width='100' src='../images/{$post_image}' alt='image'></td>";
        echo "<td>{$post_tags}</td>";

        $query = "SELECT * FROM comments WHERE comment_post_id = $post_id";
        $send_comment_query = mysqli_query($connection, $query);

        $row = mysqli_fetch_array($send_comment_query);
        $comment_id = escape($row['comment_id']);
        $count_comments = mysqli_num_rows($send_comment_query);

        echo "<td><a href='post_comments.php?id={$post_id}'>{$count_comments}</a></td>";



        echo "<td>{$post_date}</td>";
        echo "<td><a class='btn btn-primary' href='../post.php?p_id={$post_id}'>View Post</a></td>";
        echo "<td><a class='btn btn-info' href='posts.php?source=edit_post&p_id={$post_id}'>Edit</a></td>";
/*         echo "<td><a href='posts.php?delete={$post_id}'>Delete</a></td>"; */
/*         echo "<td><a href='javascript:void(0)' rel='{$post_id}'' class='delete_link'>Delete</a></td>"; */
        ?>

      <form method="post">
        <input type="hidden" name="post_id" value="<?php echo $post_id ?>">

      <?php

      echo '<td><input class="btn btn-danger" type="submit" name="delete" value="Delete"></td>';

      ?>

      </form>

      <?php
        echo "<td><a href='posts.php?reset={$post_id}'>{$post_views_count}</td>";
        echo "</tr>";

      }
      ?>

    </tbody>
  </table>
</form>

<?php 
          
  if(isset($_GET['reset'])) {
    $the_post_id = escape($_GET['reset']);
    $query = "UPDATE posts SET post_views_count = 0 WHERE post_id =" . mysqli_real_escape_string($connection, $_GET['reset']) . " ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
  }

  if(isset($_POST['delete'])) {
    $the_post_id = escape($_POST['post_id']);
    $query = "DELETE FROM posts WHERE post_id = {$the_post_id} ";
    $delete_query = mysqli_query($connection, $query);
    header("Location: posts.php");
  }

?>

<script>
          
$(document).ready(function() {
  $(".delete_link").on('click', function() {
    var id = $(this).attr('rel');
    var delete_url = 'posts.php?delete=' + id + " ";
    
    $('.modal_delete_link').attr("href", delete_url);
    
    $('#myModal').modal('show');
  })
});

</script>