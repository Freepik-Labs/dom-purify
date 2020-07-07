#!/usr/bin/env node
const createDOMPurify = require('dompurify');
const { JSDOM } = require('jsdom');

const window = new JSDOM('').window;
const DOMPurify = createDOMPurify(window);



let [dirty, config] = process.argv.slice(2)

dirty = (Buffer.from(dirty, 'base64')).toString('ascii');
config = JSON.parse(Buffer.from(config, 'base64').toString('ascii'));


const clean = DOMPurify.sanitize(dirty, config);

console.log(clean);
