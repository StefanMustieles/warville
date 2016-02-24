<?php

require "page.inc";

$homepage = new Page();

$homepage->metadescription = '';

$homepage->contentpagescripts = '<script src="https://www.google.com/recaptcha/api.js"></script>
                                <script src="/assets/js/jquery.validate.min.js"></script>
                                <script type="text/javascript">
                                    $(function() {
                                        $("#main-contact-form").submit(function(e) {
                                            e.preventDefault();
                                        }).validate({
                                            ignore: ":hidden:not(.my_cpa)",
                                            rules: {
                                                name: "required",
                                                email: {
                                                    required: true,
                                                    email: true
                                                },
                                                "hiddencode": {
                                                    required: function() {
                                                        if(grecaptcha.getResponse() == "") {
                                                            return true;
                                                        } else {
                                                            return false;
                                                        }
                                                    }
                                                }, 
                                                subject: "required",
                                                message: "required"
                                            },
                                            messages: {
                                                name: "Please enter your name",
                                                email: "Please enter a valid email address",
                                                hiddencode: "Please tick the box above to confirm your identity",
                                                subject: "Please enter a subject for your message",
                                                message: "Please enter your message"
                                            },
                                            errorClass: "formErrors",
                                            submitHandler: function(form) {
                                                $.ajax({
                                                    type: "POST",
                                                    url: "sendemail.php",
                                                    data: { name: $("[name=\"name\"]").val(), 
                                                            email: $("[name=\"email\"]").val(),
                                                            subject: $("[name=\"subject\"]").val(),
                                                            message: $("[name=\"message\"]").val(),
                                                          },
                                                    success: function(data){
                                                        $("#outputWindow").find(".modal-title").html(data);
                                                        $("#outputWindow").modal("show");
                                                        $("#submit").removeAttr("disabled");
                                                    }
                                                });
                                                $("#main-contact-form")[0].reset();
                                                grecaptcha.reset();
                                                return false;
                                            }
                                        });
                                    });
                                </script>';

$homepage->content = '<section id="contact-page">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">       
                                    <h1>Drop Us A Message</h1>
                                    <p>Here at <a href="http://quartermastersection.com">QuartermasterSection.com</a> I am constantly looking to add to the data, images and information contained on this site. My is never done.</p>
                                    <p>I welcome feedback and discussion and if you are able to help continue to build this site up of its resources I would more than appreciate any additional data and images you may come across.</p>
                                    <p>Also if you need any more information on any of the items on the site or simply want to let me know what you think of the site so far, do let me know by filling in the form below.</p>
                                    <p class="lead">Fill in all fields marked with a <span class="requiredStars">*</span> then click the Submit Message button</p>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                      </section><!--/#content-->        

                      <section id="content">
                        <div class="container">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="row contact-wrap"> 
                                        <div class="status alert alert-success" style="display: none"></div>
                                        <form id="main-contact-form" class="contact-form" name="contact-form" method="post">
                                            <div class="col-sm-5 col-sm-offset-1">
                                                <div class="form-group">
                                                    <label>Name <span class="requiredStars">*</span></label>
                                                    <input type="text" name="name" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Email <span class="requiredStars">*</span></label>
                                                    <input type="email" name="email" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <div class="g-recaptcha" data-sitekey="6LeB6RYTAAAAAIW2IMVueJ8I8TUFHmLDzbxea85h"></div>
                                                    <input type="hidden" class="my_cpa hiddencode required" name="hiddencode" id="hiddencode">
                                                </div>                       
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group">
                                                    <label>Subject <span class="requiredStars">*</span></label>
                                                    <input type="text" name="subject" class="form-control">
                                                </div>
                                                <div class="form-group">
                                                    <label>Message <span class="requiredStars">*</span></label>
                                                    <textarea name="message" id="message" class="form-control" rows="8"></textarea>
                                                </div>                        
                                                <div class="form-group">
                                                    <button type="submit" class="btn btn-primary btn-lg">Submit Message</button>
                                                </div>
                                            </div>
                                        </form>
                                </div>
                            </div><!--/.row-->
                        </div><!--/.container-->
                    </section><!--/#content-->
                    <div id="outputWindow" class="modal fade bs-example-modal-sm" tabindex="-1" role="dialog">
                        <div class="modal-dialog modal-sm">
                          <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title"></h4>
                            </div>
                          </div>
                        </div>
                      </div>';

$homepage->title = 'Contact Us - ' . $homepage->title;

$homepage->canonical = '<link rel="canonical" href="http://' . $_SERVER["HTTP_HOST"] . parse_url($_SERVER["REQUEST_URI"], PHP_URL_PATH) . '" />';

$homepage->Display();