# Contextual Service Providers
This simple yet powerful package will help you load different Service Providers depending in which context you are.

# What's it for?
Let's say you have 2 contexts in your application: an **Admin Panel** and a **RESTful WebService**. This are certainly two completely different contexts as in one context you'll maybe want to get all resources (i.e. including trashed) and in the other one you want only the active ones.

This is when Service Providers come in really handy, the only problem is that Laravel doesn't come with an out of the box solution for loading different Service Providers for different contexts giving you the possibility to registers all your repositories to a single interface and bind them through your Context's Service Provider.
