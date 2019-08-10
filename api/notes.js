export default {

}

getPostLists(){
    let counter = 0;
    let arr = [];
    const readTable = function(){
        if(counter < state.tables.length){
         
         axios.post('../ajax_quest.php', {
             'table': state.tables[counter]
         })
         .then(function (response) {
             arr.push(response.data);
             counter++;
             readTable();
         })
         .catch(function (error) {
             console.log(error);
         });
        } else {
         commit('INIT_POST_LIST', arr);
        }  
    }
    readTable();
 }


 addPost({state},payload){
     if(payload.text!='' || payload.files.length!=0){
         let data = new FormData(document.getElementById('uploadForm'));
         
         data.append('file', payload.files);

         let table = state.currentTab;
         let msg = payload.text;
         
         data.append('table', table);
         data.append('msg', msg);
         axios.post('../ajax_add.php', data, {
         headers: {
         'Content-Type': 'multipart/form-data'
         }
         }).then(function (response) {
                //this.files =[];
                 store.dispatch('initPostList');
                 console.log(response);
             })
             .catch(function (error) {
                 console.log(error);
             });
     }        
 }
 deletePost({state},payload){
     let table = state.currentTab;
     let postId = payload;
     
     axios.post('../ajax_remove.php', {
         table: table,
         postId: postId
     })
     .then(function (response) {
         store.dispatch('initPostList');
         console.log(response);
     })
     .catch(function (error) {
         console.log(error);
     });
 }