<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style media="screen">
		.completed{
			text-decoration: line-through;
		}
	</style>
</head>
<body>
	<div id="app">
		<h3>Todo List</h3>
		<input type="text" v-model="newTodo" @keyup.enter="addTodo">
		<ul>
			<li v-for="(todo,index) in todos">
				<span v-bind:class="{'completed':todo.done}
				">@{{todo.text}}</span>
				<button type="button" v-on:click="removeTodo(index,todo)">x</button>
				<button type="button" v-on:click="toggleComplete(todo)">Done</button>
			</li>

		</ul>
	</div>
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdn.jsdelivr.net/npm/vue-resource@1.5.1"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js">

<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.2/sweetalert.min.js"></script>

<script>
	new Vue({
		el:"#app",
		data:{
			newTodo:"",
			todos:[],

		},methods:{
			addTodo:function(){
				let textInput=this.newTodo;
				if(textInput){
					this.$http.post('/api/todo', 
						{text: textInput}).then(response => {
						this.todos.unshift({
							text:textInput,
							done:0
						});
						this.newTodo=''

				  }, response => {
				    // error callback
				  });
					
				}
			},
			delete:function(index){
				this.todos.splice(index,1);
			},
			removeTodo:function(index,todo){
				let id=todo.id;
				let index1=index;
				let todos1=[];
				todos1=this.todos;
				 swal({
			      title: "Are you sure?",
			      text: "",
			      buttons: [
			        'No, cancel it!',
			        'Yes, I am sure!'
			      ],
			      dangerMode: true,
			    }).then(function(isConfirm,todos1) {
			    	if (isConfirm) {
			    			swal("Success", "Perubahan disimpan", "success");
			    			Vue.http.put('api/todo/delete/'+id).then(response => {
			    				swal("Success", "Perubahan disimpan", "success");
			    			
						
				  }, response => {
				    // error callback
				  });

			    		
							
						 
			    		
			      	




			        
			      } else { 

			      	swal("Cancelled", "Perubahan dibatalkan", "error");
			       
			    }

			      });
				

			},
			toggleComplete:function(todo){


				this.$http.put('api/todo/changeDoneStatus/'+todo.id).then(response => {
					todo.done=!todo.done

				  }, response => {
				    // error callback
				  });
				
			}
		},
		mounted:function(){
			 this.$http.get('/api/todo').then(response => {
			 	let result=response.body.data;
			 	this.todos=result;
			  }, response => {
			  });
		}
	})


</script>
</body>
</html>