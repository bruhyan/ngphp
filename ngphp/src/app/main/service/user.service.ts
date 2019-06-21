import { Injectable } from '@angular/core';
import { Observable, throwError } from 'rxjs';
import {HttpClient, HttpHeaders, HttpErrorResponse} from '@angular/common/http';
import {catchError, map} from 'rxjs/operators';

import {User} from '../model/User';

const httpOptions = {
  header: new HttpHeaders({ 'Content-Type': 'application/json'})
};

@Injectable({
  providedIn: 'root'
})
export class UserService {

  users : User[];
  baseUrl = 'http://localhost/ngphp'

  constructor(private httpClient : HttpClient) { }

  get() : any {
    return this.httpClient.get(`${this.baseUrl}/list`).pipe(
      map((res)=> {
        console.log("look "+res['data'][0].email);
        this.users = res['data'];
        return this.users;
      })
    )
  }

  store(user : User) {
    return this.httpClient.post(`${this.baseUrl}/store`, {data: user}).pipe(
      map((res)=> {
        this.users.push(res['data']);
        return this.users;
      })
    )
  }
}
