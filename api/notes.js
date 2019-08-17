import axios from 'axios';

const tables = ['notes','code','books']

async function getPosts(){
    let posts = [];
    for(let i = 0; i < tables.length; i++){
        let response =  await axios.post('../ajax_quest.php', {
            'table': tables[i]
        })
        posts.push(response.data);
        
    }

    return posts;    
}

async function deletePost(table,postId){
    await axios.post('../ajax_remove.php', {
        table: table,
        postId: postId
    })   
}

async function changePost(table,id,text){
    await axios.post('../ajax_change.php', {
        table: table,
        postId: id,
        text: text
    })   
}

async function addPost(postData){
    await axios.post('../ajax_add.php', postData, {
        headers: {
        'Content-Type': 'multipart/form-data'
        }
    })
}

export default {
    getPosts,
    deletePost,
    addPost,
    changePost
}

