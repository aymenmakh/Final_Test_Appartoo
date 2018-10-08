
import { AppartooService } from './Services/Appartoo.service';
import { BrowserModule } from '@angular/platform-browser';
import { NgModule } from '@angular/core';
import { RouterModule } from '@angular/router';
import { AppComponent } from './app.component';
import {HttpModule} from '@angular/http';
import { AppartooComponent } from './Appartoo/Appartoo.component';
import { APP_BASE_HREF } from '@angular/common';
import { LoginComponent } from './login/login.component';
import { FormsModule } from '@angular/forms';
import { map } from "rxjs/operators";
import { RegisterComponent } from './register/register.component';
import { UpdateComponent } from './update/update.component';
import { AmisComponent } from './amis/amis.component';
import { FilterPipe } from './filter.pipe';
import { NewAmiComponent } from './newAmi/newAmi.component';



@NgModule({
  declarations: [
    AppComponent,
    AppartooComponent,
    LoginComponent,
    RegisterComponent,
    UpdateComponent,
    AmisComponent,
    FilterPipe,
    NewAmiComponent,
],
  imports: [
    BrowserModule,
    HttpModule,
    FormsModule,
    RouterModule.forRoot([
      {path:'profile/:id',component:AppartooComponent},
      {path:'login',component:LoginComponent},
      {path:'register',component:RegisterComponent},
      {path:'modif/:id',component:UpdateComponent},
      {path:'amis',component:AmisComponent},
      {path:'newAmi',component:NewAmiComponent},
    
      
    ])
  ],
  providers: [
     AppartooService,
    { provide: APP_BASE_HREF, useValue: '/' }
  ],
  bootstrap: [AppComponent]
})
export class AppModule { }
