import { AppartooService } from './../Services/Appartoo.service';
import { Component, OnInit } from '@angular/core';
import {Router} from "@angular/router";


@Component({
  selector: 'app-login',
  templateUrl: './login.component.html',
  styleUrls: ['./login.component.css']
})
export class LoginComponent implements OnInit {

  username : any;
  password : any;

  constructor(private service:AppartooService,private router: Router) { }

  ngOnInit() {
    localStorage.removeItem("id");
    console.log(localStorage.getItem("id"))
}

  Dologin(){
   this.service.login(this.username,this.password).subscribe(resp =>{
    localStorage.setItem("id",JSON.stringify(resp[0].id));
    console.log(localStorage.getItem("id"))
    this.router.navigate(['profile',resp[0].id])
  });

  }

}
