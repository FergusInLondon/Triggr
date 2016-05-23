# Work In Progress: Triggr

[![Build Status](https://travis-ci.org/FergusInLondon/Triggr.svg?branch=master)](https://travis-ci.org/FergusInLondon/Triggr) [coverage]() [![Code Climate](https://codeclimate.com/github/FergusInLondon/Triggr/badges/gpa.svg)](https://codeclimate.com/github/FergusInLondon/Triggr) [![Issue Count](https://codeclimate.com/github/FergusInLondon/Triggr/badges/issue_count.svg)](https://codeclimate.com/github/FergusInLondon/Triggr)

This is a Workflow Engine based on the [Hoa](http://hoa-project.net/En/) project's "[Ruler](http://hoa-project.net/En/Literature/Hack/Ruler.html)" library.

It's composed of `Ruleset` objects, a `ContextProvider` interface and a `EvaluationEngine`.

The primary idea is to implement the `ContextProviderInterface` on your models, and then store your rules either in the database or in individual objects - creating `Ruleset` objects from them.

The EvaluationEngine can then be triggered via a CronJob or an Events Handling system. A rough (draft API) looks something like this:

```php

$evalEngine = new EvaluationEngine();
$evalEngine->addRulesets([
	Some/Namespace/RulesetOne::class,
	Some/Namespace/RulesetTwo::class,
	Some/Namespace/RulesetThree::class,
	Some/Namespace/RulesetFour::class,
	Some/Namespace/RulesetFive::class,
]);

foreach ($contextProviders as $provider) {
	$evalEngine->evaluate( $provider );
}

```

## Testing

Testing is done via PHPSpec, and tests that the public interface works as expected - but makes no guarantees as to the internal workings. As such, if you wish to use this project please stick to the public API as seen in the above example(s).

A [full build history](https://travis-ci.org/FergusInLondon/Triggr/builds) for this project is available on Travis CI.

## License

All code contained in this repository is licensed under **[The MIT License](https://opensource.org/licenses/MIT)**.

> Copyright © 2016 Fergus Morrow <fergus@fergus.london>
> 
> Permission is hereby granted, free of charge, to any person
obtaining a copy of this software and associated documentation
files (the “Software”), to deal in the Software without
restriction, including without limitation the rights to use,
copy, modify, merge, publish, distribute, sublicense, and/or sell
copies of the Software, and to permit persons to whom the
Software is furnished to do so, subject to the following
conditions:
> 
> The above copyright notice and this permission notice shall be
included in all copies or substantial portions of the Software.
> 
> THE SOFTWARE IS PROVIDED “AS IS”, WITHOUT WARRANTY OF ANY KIND,
EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES
OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND
NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT
HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY,
WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING
FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR
OTHER DEALINGS IN THE SOFTWARE.
