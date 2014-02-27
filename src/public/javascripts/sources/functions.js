/**************************************************************************/
/* String Functions                                                       */
/* Last update: 18/05/2012 - 01:03h                                       */
/**************************************************************************/

/**
 *	substr_count - Count the number of substring occurrences
 *	http://www.internetdoc.info/javascript-php-equivalent/substr_count.htm
 *
 *	Author: Sean Gallagher
 *	Last update: 18/05/2012 - 01:03h
 *
 *	@param	string	The string to search in
 *	@param	integer	The substring to search for
 *	@param	integer	The offset where to start counting
 *	@param	integer	The maximum length after the specified offset to search for the substring
 *	@return	integer	The number of times
*/
function substr_count(string,substring,start,length)
{
 var c = 0;
 if(start) { string = string.substr(start); }
 if(length) { string = string.substr(0,length); }
 for (var i=0;i<string.length;i++)
 {
  if(substring == string.substr(i,substring.length))
  c++;
 }
 return c;
}

/**
 *	strstr - Find the first occurrence of a string
 *	http://phpjs.org/functions/strstr:551
 *
 *	Author: Kevin van Zonneveld $ Onno Marsman
 *	Last update: 18/05/2012 - 01:03h
 *
 *	@param	string	The string to search in
 *	@param	integer	The substring to search for
 *	@param	boolean	Returns the part of the haystack before the first occurrence of the needle (excluding the needle). 
 *	@return	string	Part of haystack string
*/
function strstr (haystack, needle, bool) {
    // http://kevin.vanzonneveld.net
    // +   original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +   bugfixed by: Onno Marsman
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // *     example 1: strstr('Kevin van Zonneveld', 'van');
    // *     returns 1: 'van Zonneveld'
    // *     example 2: strstr('Kevin van Zonneveld', 'van', true);
    // *     returns 2: 'Kevin '
    // *     example 3: strstr('name@example.com', '@');
    // *     returns 3: '@example.com'
    // *     example 4: strstr('name@example.com', '@', true);
    // *     returns 4: 'name'
    var pos = 0;

    haystack += '';
    pos = haystack.indexOf(needle);
    if (pos == -1) {
        return false;
    } else {
        if (bool) {
            return haystack.substr(0, pos);
        } else {
            return haystack.slice(pos);
        }
    }
}

/**
 *	strcmp - Binary safe string comparison
 *	http://phpjs.org/functions/strcmp:533
 *
 *	Author: Waldo Malqui Silva $ Steve Hilder $ Kevin van Zonneveld $ gorthaur
 *	Last update: 18/05/2012 - 01:03h
 *
 *	@param	string	The first string
 *	@param	string	The second string
 *	@return	integer	Returns < 0 if str1 is less than str2; > 0 if str1 is greater than str2, and 0 if they are equal
*/
function strcmp (str1, str2) {
    // http://kevin.vanzonneveld.net
    // +   original by: Waldo Malqui Silva
    // +      input by: Steve Hilder
    // +   improved by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    // +    revised by: gorthaur
    // *     example 1: strcmp( 'waldo', 'owald' );
    // *     returns 1: 1
    // *     example 2: strcmp( 'owald', 'waldo' );
    // *     returns 2: -1
    return ((str1 == str2) ? 0 : ((str1 > str2) ? 1 : -1));
}