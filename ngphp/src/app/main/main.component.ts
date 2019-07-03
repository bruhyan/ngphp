import { Component, OnInit } from '@angular/core';
import { UserService } from './service/user.service';
import { User } from './model/User';
import { FormBuilder, FormGroup } from '@angular/forms';
import {HttpClient} from '@angular/common/http';
import { UploadService } from './service/upload.service';

@Component({
  selector: 'app-main',
  templateUrl: './main.component.html',
  styleUrls: ['./main.component.css']
})
export class MainComponent implements OnInit {
  user = new User('', '', '', '')
  // emailInput: String;
  // passwordInput: String;
  // nameInput: String;
  // dropdownInput: String;

  users: User[];
  uploadForm: FormGroup;
  form: FormGroup;
  uploadResponse;
  uploadedFiles;

  constructor(private userService : UserService, private formBuilder : FormBuilder, private httpClient : HttpClient, private uploadService: UploadService) { }

  ngOnInit() {
    this.get();
    this.uploadForm = this.formBuilder.group({
      profile: ['']
    });

    this.form = this.formBuilder.group({
      avatar: ['']
    });

    this.uploadService.getUploadedFiles().subscribe(
      (res) => {
        this.uploadedFiles = res;
      }
    )
  }

  get() {
    // console.log(this.emailInput);
    this.userService.get().subscribe(
      (res)=> {
        console.log(res);
        this.users = res;
      }
    )
  }

  post() {
    console.log(this.user);
    this.userService.store(this.user).subscribe(
      (res)=> {
        console.log(res)
      }
    )
    
  }

  onSubmit() {
    console.log("on submit");
    const formData = new FormData();
    // formData.append('file', this.uploadForm.get('profile').value);

    // this.httpClient.post<any>("http://localhost/ngphp/upload", formData).subscribe(
    //   (res) => console.log(res),
    //   (err) => console.log(err)
      
    // )
    formData.append('avatar', this.form.get('avatar').value);
    this.uploadService.uploadFile(formData).subscribe(
      (res) => {
        this.uploadResponse = res;
        console.log(res);
        alert(res);
      },
      (err) => {
        console.log(err);
      }
    )
  }

  onFileSelect(event) {
    if(event.target.files.length > 0) {
      const file = event.target.files[0];
      // this.uploadForm.get('profile').setValue(file);
      this.form.get('avatar').setValue(file);
    }
  }

  test() {
    this.uploadService.getUploadedFiles().subscribe(
      (res) => {
        this.uploadedFiles = res;
      }
    )
  }

}
