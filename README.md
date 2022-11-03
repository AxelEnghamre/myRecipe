<img src="https://media.giphy.com/media/l0EwXZ4H4SXKrCHMQ/giphy.gif" width="100%" />

# myRecipe

A site to create update read and delete recipes.

# Installation

This project uses [tailwind](https://tailwindcss.com) therefore to build a new output.css file [node](https://nodejs.dev/en/) is requierd to run a tailwind compiler.

This project needs a mySQL databsae. To connect add a env.php like env.sample.php and insert the values for a new connection.

The project is hosted on [enghamre.com](https://enghamre.com)

# Code Review

Code review written by [Magnus Vargvinter](https://github.com/magnusvv).

1.  Utvecklarvänlighet: Det är svårt att följa filstrukturen. tydliggör gärna i repositoriet vad som används, och vad som inte används (om något).
2.  Utvecklarvänlighet: Om du skickas vidare från en php-fil till en annan (genom knapptryck, inmatning, val e d), och det inte är helt uppenbart var, skriv då gärna en kommentar vid eventet om var du kommer att skickas. Exempelvis är det lite svårt att se vad som händer efter första index.php och de tre php-filer som ropas in i den. Jag kan ana hur man kommer till search.php, men det blir otydligare ju djupare man kommer in i strukturen.
3.  Utvecklarvänlighet: Till viss del förstår jag varför du gjort på det sättet, men för att få ned antalet php-filer (och minska mängden kod-text i dem) i ett webb-objekt, försök så långt det går att samla så många funktionsdefinitioner som möjligt på samma ställe. Det är bättre att ha få, eller bara en, functions-php:er där du istället lägger in definitionerna i olika avdelningar där du bara kommenterar vad avdelningarna tillhör.
4.  Användarvänlighet: Lägg till en "back"-länk eller "back"-knapp på sidor som inte är inloggsidan.
5.  Användarvänlighet: Hamburgerknappen har bara ett id, inget namn. Småsak kanske, men en digital uppläsare kan inte tala om vad den heter/gör då.

# Testers

Tested by the following people:

1. Robin Persson
2. Magnus Vargvinter
