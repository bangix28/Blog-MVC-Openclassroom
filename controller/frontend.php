<?php

// Chargement des classes
require_once('model/CommentManager.php');
require_once('model/PostManager.php');

function listPosts()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $posts = $postManager->getPosts();

    require('view/frontend/listPostsView.php');
}

function post()
{
    $postManager = new \OpenClassrooms\Blog\Model\PostManager();
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $post = $postManager->getPost($_GET['id']);
    $comments = $commentManager->getComments($_GET['id']);

    require('view/frontend/postView.php');
}

function addComment($postId, $author, $comment)
{
    $commentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedLines = $commentManager->postComment($postId, $author, $comment);

    if ($affectedLines === false) {
        throw new Exception('Impossible d\'ajouter le commentaire !');
    }
    else {
        header('Location: index.php?action=post&id=' . $postId);
    }
}
function getComment()
{
    $commentManager = new OpenClassrooms\Blog\Model\CommentManager();
    $comment = $commentManager->comment();

    require ('view/frontend/editCommentView.php');
}
function editComment()
{
    $commmentManager = new \OpenClassrooms\Blog\Model\CommentManager();

    $affectedComment = $commmentManager->editComment();
    if ($affectedComment == false)
    {
        throw new Exception('Impossible de modifier le commentaire !');
    }else{
        header('Location: index.php?action=comment&id=' . $_GET['id']);
    }
}
