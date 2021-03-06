interface Array<T> {
    remove(elem?: T): boolean;
    last?(): T;

    pop_front(): T | undefined;
}

interface JQuery {
    tmpl(values?: any) : JQuery;
}

interface JQueryStatic<TElement extends Node = HTMLElement> {
    spawn<K extends keyof HTMLElementTagNameMap>(tagName: K): JQuery<HTMLElementTagNameMap[K]>;
}

interface String {
    format(...fmt): string;
    format(arguments: string[]): string;
}

if (!Array.prototype.remove) {
    Array.prototype.remove = function<T>(elem?: T): boolean {
        const index = this.indexOf(elem, 0);
        if (index > -1) {
            this.splice(index, 1);
            return true;
        }
        return false;
    }
}

if (!Array.prototype.pop_front) {
    Array.prototype.pop_front = function<T>(): T {
        if(this.length == 0) return undefined;
        return this.splice(0, 1)[0];
    }
}


if (!Array.prototype.last){
    Array.prototype.last = function(){
        if(this.length == 0) return undefined;
        return this[this.length - 1];
    };
}

if(typeof ($) !== "undefined") {
    if(!$.spawn) {
        $.spawn = function<K extends keyof HTMLElementTagNameMap>(tagName: K): JQuery<HTMLElementTagNameMap[K]> {
            return $(document.createElement(tagName));
        }
    }
}

if (!String.prototype.format) {
    String.prototype.format = function() {
        const args = arguments;
        let array = args.length == 1 && $.isArray(args[0]);
        return this.replace(/\{\{|\}\}|\{(\d+)\}/g, function (m, n) {
            if (m == "{{") { return "{"; }
            if (m == "}}") { return "}"; }
            return array ? args[0][n] : args[n];
        });
    };
}

function concatenate(resultConstructor, ...arrays) {
    let totalLength = 0;
    for (const arr of arrays) {
        totalLength += arr.length;
    }
    const result = new resultConstructor(totalLength);
    let offset = 0;
    for (const arr of arrays) {
        result.set(arr, offset);
        offset += arr.length;
    }
    return result;
}

function formatDate(secs: number) : string {
    let years   = Math.floor(secs  / (60 * 60 * 24 * 365));
    let days    = Math.floor(secs  / (60 * 60 * 24)) % 365;
    let hours   = Math.floor(secs / (60 * 60)) % 24;
    let minutes = Math.floor(secs / 60) % 60;
    let seconds = Math.floor(secs % 60);

    let result = "";
    if(years > 0)
        result += years + " years ";
    if(years > 0 || days > 0)
        result += days + " days ";
    if(years > 0 || days > 0 || hours > 0)
        result += hours + " hours ";
    if(years > 0 || days > 0 || hours > 0 || minutes > 0)
        result += minutes + " minutes ";
    if(years > 0 || days > 0 || hours > 0 || minutes > 0 || seconds > 0)
        result += seconds + " seconds ";
    else
        result = "now ";

    return result.substr(0, result.length - 1);
}