class Token {
    isValid(token){
        const payload = this.payload(token);
        if(payload){
            return payload.iss === "http://127.0.0.1:8000/api/auth/login" ? true : false;
        }
        return false;
    }

    payload(token){
        if(token !== null){
            const payload = token.split('.')[1];
            return this.decode(payload);
        }
        return false;
    }

    decode(payload){
        return JSON.parse(atob(payload));
    }
}

export default Token = new Token();
